<?php

namespace App\V1\WorkerClasses;

use App\V1\Facades\AppHelper;

class BaseWorker
{
    /**
     * @param $mapper
     * @return static
     */
    public static function using($mapper) {
        $instance = new static();
        collect($mapper)->each(function ($value, $setter) use(&$instance) {
            $functionName = AppHelper::setter($setter);
            if(method_exists($instance, $functionName)
                && is_callable(array($instance, $functionName))) {
                $instance->$functionName($value ?? null);
            }
        });
        return $instance;
    }
}
