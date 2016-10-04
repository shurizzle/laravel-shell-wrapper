<?php

namespace Shura\Shell\Support\Facades;

class ReturnValue extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\ReturnValue::class;
    }
}
