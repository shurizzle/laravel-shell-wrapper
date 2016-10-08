<?php

namespace Shura\Shell\Support\Providers;

use Illuminate\Support\ServiceProvider;

class ShellServiceProvider extends ServiceProvider
{
    protected $runnerClass;
    protected $runnerAliases;
    protected $provides;

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../../config/config.php' => config_path('shell.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../../config/config.php', config_path('shell'));

        $tryClasses = config('shell.tryClasses', [
            \Shura\Shell\Proc::class,
            \Shura\Shell\Exec::class,
            \Shura\Shell\Passthru::class,
            \Shura\Shell\System::class,
            \Shura\Shell\ShellExec::class,
        ]);

        $this->runnerClass = $this->getFirstValidClass($tryClasses);
        $this->generateAliases();
        $this->generateProvides();

        if (isset($this->runnerClass)) {
            $this->app->bind($this->runnerClass, $this->runnerClass);

            if (isset($this->runnerAliases)) {
                foreach ($this->runnerAliases as $alias) {
                    $this->app->alias($this->runnerClass, $alias);
                }
            }
        }
    }

    public function provides()
    {
        return $this->provides;
    }

    private function getFirstValidClass($tryClasses)
    {
        foreach ($tryClasses as $klass) {
            if (method_exists($klass, 'isValid') && $klass::isValid()) {
                return $klass;
            }
        }
    }

    private function generateAliases()
    {
        static $interfaces = [
            \Shura\Shell\Support\Contracts\ReturnValue::class,
            \Shura\Shell\Support\Contracts\ReturnValueStandardError::class,
            \Shura\Shell\Support\Contracts\ReturnValueStandardOut::class,
            \Shura\Shell\Support\Contracts\ReturnValueStandardOutStandardError::class,
            \Shura\Shell\Support\Contracts\Runner::class,
            \Shura\Shell\Support\Contracts\StandardError::class,
            \Shura\Shell\Support\Contracts\StandardOut::class,
            \Shura\Shell\Support\Contracts\StandardOutStandardError::class,
        ];

        if (isset($this->runnerClass)) {
            $interfaces = (new \ReflectionClass($this->runnerClass))->getInterfaceNames();
            $this->runnerAliases = array_filter($interfaces, function ($interface) use (&$interfaces) {
                return in_array($interface, $interfaces);
            });
        }
    }

    private function generateProvides()
    {
        if (isset($this->runnerClass)) {
            $provides = [$this->runnerClass];

            if (isset($this->runnerAliases) && count($this->runnerAliases) > 0) {
                $provides = array_merge($provides, $this->runnerAliases);
            }

            $this->provides = $provides;
        }
    }
}
