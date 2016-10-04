<?php

namespace Shura\Shell\Support\Facades;

class ReturnValueStandardOutStandardError extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\ReturnValueStandardOutStandardError::class;
    }
}
