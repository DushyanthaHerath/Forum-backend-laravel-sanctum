<?php

namespace App\V1\Providers;

use App\V1\Contracts\ApiInterface;
use App\V1\Contracts\AppHelperInterface;
use App\V1\Contracts\PostRepositoryInterface;
use App\V1\Contracts\PostServiceInterface;
use App\V1\Repositories\PostRepository;
use App\V1\Services\API\ApiResponse;
use App\V1\Services\PostService;
use App\V1\Services\Utils\AppHelper;
use Illuminate\Support\ServiceProvider;

class ApiAppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind services
        self::services();
        // Bind Repositories
        self::repositories();
        // Bind Other Classes
        self::other();
    }

    public static function services() {
        app()->bind(PostServiceInterface::class, PostService::class);
    }

    public static function repositories() {
        app()->bind(PostRepositoryInterface::class, PostRepository::class);
    }

    public static function other() {
        app()->bind(ApiInterface::class, function () {
            return new ApiResponse();
        });

        app()->bind(AppHelperInterface::class, function () {
            return new AppHelper();
        });
    }
}
