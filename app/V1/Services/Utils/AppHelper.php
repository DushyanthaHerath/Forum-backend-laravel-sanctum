<?php

namespace App\V1\Services\Utils;

use App\V1\Contracts\AppHelperInterface;
use Illuminate\Support\Facades\Auth;

class AppHelper implements AppHelperInterface
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user() {
        return Auth::user();
    }

    /**
     * @return false
     */
    public function userRole() {
        return $this->user()->role->key ?: false;
    }

    /**
     * @return bool
     */
    public function isAdmin() {
        return $this->userRole() == ROLE_ADMIN;
    }

    /**
     * @return string
     */
    public function userId() {
        return $this->user()->id ?? '';
    }

    /**
     * @param $name
     * @return string
     */
    public function setter($name) {
        return 'set' . str_replace('_', '', ucwords($name, '_'));
    }
}
