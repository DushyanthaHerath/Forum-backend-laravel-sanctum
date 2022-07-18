<?php

namespace App\V1\Services;

use App\V1\Contracts\PostRepositoryInterface;
use App\V1\Contracts\PostServiceInterface;
use App\V1\Exceptions\ApiException;
use App\V1\WorkerClasses\PostWorker;
use Illuminate\Support\Facades\Auth;
use App\V1\Exceptions\BadRequestApiException;

class PostService extends BaseService implements PostServiceInterface
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function all($params =[]) {
        // Parameters
        $filters = [];
        $search = '';
        $page = 1;
        $perPage = 15;


        if(!empty($params['search'])) {
            $search = $params['Search'];
        }

        if(!empty($params['user_role']) && $params['user_role'] != ROLE_ADMIN) {
            $filters['status'] = POST_APPROVED;
        }

        // Pagination parameters missing
        if(empty($params['page']) && empty($params['per_page'])) {
            throw new BadRequestApiException();
        }

        if(!empty($params['page'])) {
            $page =  $params['page'];
        }

        if(!empty($params['per_page'])) {
            $perPage =  $params['per_page'];
        }

        return $this
            ->postRepository
            ->all($search, $filters, $page, $perPage)
            ->through(function ($post) {
                // Transform data before return
                return PostWorker::using($post)->transform();
            });
    }

    /**
     * @param $data
     * @return void
     * @throws \Throwable
     */
    public function save($data) {
        $formattedData = PostWorker::using($data)->getSaveArray();

        // Save data
        $saved = $this->postRepository->save($formattedData);

        // Error report
        throw_if(empty($saved), new ApiException("Server Error! Please Try Again."));
    }

    /**
     * @return mixed
     */
    public function getPostCategories() {
        return $this
            ->postRepository
            ->getPostCategories();
    }

    public function approvePost($params) {
        // Post id missing
        throw_if(empty($params['id']), new BadRequestApiException("Post ID missing"));

        $approvePost = PostWorker::using($params)->getApproveArray();

        return $this
            ->postRepository
            ->approvePost($approvePost);
    }
}
