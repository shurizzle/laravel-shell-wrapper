<?php

namespace Shura\Shell;

use Shura\Shell\Support\Functions;

class Passthru extends \AdamBrett\ShellWrapper\Runners\Passthru
    implements \Shura\Shell\Support\Contracts\ReturnValue
{
    public static function isValid()
    {
        return Functions::isValid('passthru');
    }
}
