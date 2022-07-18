<?php

namespace App\V1\WorkerClasses;

use App\V1\Contracts\DataControlInterface;
use App\V1\Contracts\TransformInterface;
use App\V1\Facades\AppHelper;
use Carbon\Carbon;

class PostWorker extends BaseWorker implements TransformInterface, DataControlInterface
{
    protected $id;
    protected $title;
    protected $content;
    protected $status;
    protected $category;
    protected $categoryId;
    protected $postedBy;
    protected $approvedBy;
    protected $createdAt;
    protected $avatar;

    /**
     * @return array
     */
    public function transform() {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'status' => $this->getStatus(),
            'category' => $this->getCategory(),
            'avatar' => $this->getAvatar(),
            'posted_by' => $this->getPostedBy() ?? '',
            'approved_by' => $this->getApprovedBy() ?? '',
            'created_at' => Carbon::parse($this->getCreatedAt())->toDayDateTimeString()
        ];
    }

    /**
     * @return array
     */
    public function getSaveArray() {
        return [
            'title' => $this->getTitle(),
            'content' => $this->getContent(),
            'status' => $this->getStatus() ?? POST_PENDING,
            'category_id' => $this->getCategoryId(),
            'posted_by' => $this->getPostedBy() ?? '',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString()
        ];
    }

    /**
     * @return array
     */
    public function getApproveArray() {
        return [
            'id' => $this->getId(),
            'approved_by' => $this->getApprovedBy(),
            'status' => POST_APPROVED,
            'updated_at' => Carbon::now()->toDateTimeString()
        ];
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return PostWorker
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return PostWorker
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     * @return PostWorker
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return PostWorker
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostedBy()
    {
        return $this->postedBy;
    }

    /**
     * @param mixed $postedBy
     * @return PostWorker
     */
    public function setPostedBy($postedBy)
    {
        $this->postedBy = $postedBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getApprovedBy()
    {
        return $this->approvedBy;
    }

    /**
     * @param mixed $approvedBy
     * @return PostWorker
     */
    public function setApprovedBy($approvedBy)
    {
        $this->approvedBy = $approvedBy;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return PostWorker
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     * @return PostWorker
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @param mixed $categoryId
     * @return PostWorker
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return PostWorker
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
