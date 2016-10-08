<?php

namespace Shura\Shell;

use Shura\Shell\Support\Functions;

class ShellExec extends \AdamBrett\ShellWrapper\Runners\ShellExec
    implements \Shura\Shell\Support\Contracts\Runner
{
    public static function isValid()
    {
        return Functions::isValid('shell_exec');
    }
}
