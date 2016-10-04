<?php

namespace Shura\Shell\Support\Facades;

class Runner extends Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return \Shura\Shell\Support\Contracts\Runner::class;
    }
}
