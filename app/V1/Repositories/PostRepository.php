<?php

namespace App\V1\Repositories;

use App\V1\Contracts\PostRepositoryInterface;
use Illuminate\Support\Facades\DB;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct()
    {
    }


    /**
     * @param $search
     * @param $filters
     * @param $page
     * @param $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all($search, $filters, $page, $perPage) {
        $result = DB::table('posts')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->join('users', 'users.id', '=', 'posts.posted_by')
            ->select(['posts.title','posts.content','posts.status','categories.name as category','posts.created_at','posts.approved_by', 'users.name as posted_by', 'users.avatar as avatar']);

        if($search) {
            $result->where(function ($query) use ($search) {
                $query
                    ->where('content', 'like', '%' . $search . '%')
                    ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        if($filters) {
            collect($filters)->each(function ($filter, $name) use (&$result) {
                $result->where($name, 'like', '%' . $filter . '%');
            });
        }

        return $result->paginate($perPage, $columns = ['*'], 'page', $page);
    }

    /**
     * @param $post
     * @return int
     */
    public function save($post) {
        return DB::table('posts')->insertGetId($post);
    }

    /**
     * @return mixed
     */
    public function getPostCategories() {
        return DB::table('categories')->get()->all();
    }

    /**
     * @param $post
     * @return mixed
     */
    public function approvePost($post) {
        return DB::table('posts')
            ->update($post)
            ->where($post['id']);
    }
}
