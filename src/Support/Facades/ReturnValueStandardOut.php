<?php

namespace Shura\Shell\Support\Facades;

class ReturnValueStandardOut extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\ReturnValueStandardOut::class;
    }
}
