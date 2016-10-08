<?php

namespace Shura\Shell;

use Shura\Shell\Support\Functions;

class Proc extends \AdamBrett\ShellWrapper\Runners\Proc
    implements \Shura\Shell\Support\Contracts\ReturnValueStandardOutStandardError
{
    public static function isValid()
    {
        return Functions::isValid('proc_open');
    }
}
