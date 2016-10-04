<?php

namespace Shura\Shell\Providers;

use Illuminate\Support\ServiceProvider;

class ShellServiceProvider extends ServiceProvider
{
    protected $runnerClass;
    protected $runnerAliases;
    protected $provides;

    public function __construct($app)
    {
        parent::__construct($app);

        $disabled = explode(',', ini_get('disable_functions'));

        if (function_exists('proc_open') && !in_array('proc_open', $disabled)) {
            $this->runnerClass = \Shura\Shell\Proc::class;
            $this->runnerAliases = [
                \Shura\Shell\Support\Contracts\ReturnValueStandardOutStandardError::class,
                \Shura\Shell\Support\Contracts\StandardOutStandardError::class,
                \Shura\Shell\Support\Contracts\ReturnValueStandardOut::class,
                \Shura\Shell\Support\Contracts\ReturnValueStandardError::class,
                \Shura\Shell\Support\Contracts\StandardError::class,
                \Shura\Shell\Support\Contracts\StandardOut::class,
                \Shura\Shell\Support\Contracts\ReturnValue::class,
                \Shura\Shell\Support\Contracts\Runner::class,
            ];
        } elseif (function_exists('exec') && !in_array('exec', $disabled)) {
            $this->runnerClass = \Shura\Shell\Exec::class;
            $this->runnerAliases = [
                \Shura\Shell\Support\Contracts\ReturnValue::class,
                \Shura\Shell\Support\Contracts\Runner::class,
            ];
        } elseif (function_exists('passthru') && !in_array('passthru', $disabled)) {
            $this->runnerClass = \Shura\Shell\Passthru::class;
            $this->runnerAliases = [
                \Shura\Shell\Support\Contracts\ReturnValue::class,
                \Shura\Shell\Support\Contracts\Runner::class,
            ];
        } elseif (function_exists('system') && !in_array('system', $disabled)) {
            $this->runnerClass = \Shura\Shell\System::class;
            $this->runnerAliases = [
                \Shura\Shell\Support\Contracts\ReturnValue::class,
                \Shura\Shell\Support\Contracts\Runner::class,
            ];
        } elseif (function_exists('shell_exec') && !in_array('shell_exec', $disabled)) {
            $this->runnerClass = \Shura\Shell\ShellExec::class;
            $this->runnerAliases = [\Shura\Shell\Support\Contracts\Runner::class];
        }

        $this->provides = array_merge([$this->runnerClass], $this->runnerAliases);
    }

    public function register()
    {
        $this->app->bind($this->runnerClass, $this->runnerClass);
        foreach ($this->runnerAliases as $alias) {
            $this->app->bind($alias, $this->runnerClass);
        }
    }

    public function provides()
    {
        return $this->provides;
    }
}
