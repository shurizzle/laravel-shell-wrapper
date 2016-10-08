<?php

namespace Shura\Shell;

use Shura\Shell\Support\Functions;

class System extends \AdamBrett\ShellWrapper\Runners\System
    implements \Shura\Shell\Support\Contracts\ReturnValue
{
    public static function isValid()
    {
        return Functions::isValid('system');
    }
}
