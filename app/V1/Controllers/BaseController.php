<?php

namespace App\V1\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends  Controller
{
    /**
     * @return array
     */
    public static function processParameters(): array
    {
        return request()->all();
    }

    /**
     * @param $rules
     * @return array|void
     */
    public static function validateUsing($rules) {
        return request()->validate($rules);
    }
}
