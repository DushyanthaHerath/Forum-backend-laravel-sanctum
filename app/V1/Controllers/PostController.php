<?php

namespace App\V1\Controllers;

use App\V1\Contracts\PostServiceInterface;
use App\V1\Facades\API;
use App\V1\Facades\AppHelper;

class PostController extends BaseController
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return \App\V1\Services\API\ApiResponse
     * @throws \App\V1\Exceptions\BadRequestApiException
     */
    public function all() {
        // Sanitize parameters
        $params = self::processParameters();

        // User type
        $params['user_role'] = AppHelper::userRole();

        // Get data
        $posts = $this->postService->all($params);

        // Send formatted response
        return API::response(200, 'Fetching filtered posts, successful', $posts);
    }

    /**
     * @return \App\V1\Services\API\ApiResponse
     * @throws \Throwable
     */
    public function save() {
        // Sanitize parameters
        $data = self::processParameters();

        $data['posted_by'] = AppHelper::userId();

        self::validateUsing([
            'title' => ['required'],
            'content' => ['required'],
        ]);

        // Save data
        $post = $this->postService->save($data);

        // Send formatted response
        return API::response(200, 'Post saved successfully', []);
    }

    /**
     * @return \App\V1\Services\API\ApiResponse
     */
    public function getPostCategories() {
        // Get data
        $categories = $this->postService->getPostCategories();

        // Send formatted response
        return API::response(200, 'Fetching categories, successful', $categories);
    }

    /**
     * @return \App\V1\Services\API\ApiResponse
     */
    public function approvePost() {
        // Sanitize parameters
        $params = self::processParameters();

        $params['approved_by'] = AppHelper::userId();

        // Get data
        $categories = $this->postService->approvePost($params);

        // Send formatted response
        return API::response(200, 'Post approved successful', []);
    }

    public function test() {
        dd(AppHelper::userRole());
        return $this->postService->all();
    }
}
