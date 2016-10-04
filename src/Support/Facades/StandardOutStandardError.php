<?php

namespace Shura\Shell\Support\Facades;

class StandardOutStandardError extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\StandardOutStandardError::class;
    }
}
