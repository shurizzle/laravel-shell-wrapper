<?php

namespace Shura\Shell\Support\Facades;

class StandardOut extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\StandardOut::class;
    }
}
