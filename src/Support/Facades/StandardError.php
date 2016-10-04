<?php

namespace Shura\Shell\Support\Facades;

class StandardError extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\StandardError::class;
    }
}
