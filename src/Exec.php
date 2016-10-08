<?php

namespace Shura\Shell;

use Shura\Shell\Support\Functions;

class Exec extends \AdamBrett\ShellWrapper\Runners\Exec
    implements \Shura\Shell\Support\Contracts\ReturnValue
{
    public static function isValid()
    {
        return Functions::isValid('exec');
    }
}
