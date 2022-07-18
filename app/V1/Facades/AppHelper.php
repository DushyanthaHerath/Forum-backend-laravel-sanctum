<?php

namespace App\V1\Facades;

use App\V1\Contracts\AppHelperInterface;
use Illuminate\Support\Facades\Facade;

class AppHelper extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AppHelperInterface::class;
    }
}
