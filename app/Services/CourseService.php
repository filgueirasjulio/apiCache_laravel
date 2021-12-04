<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $repository;
    /**
     * __construct
     *
     * @param  mixed $courseService
     * @return void
     */
    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }
        
    /**
     * getCourses
     *
     * @return collection
     */
    public function getCourses()
    {
        return $this->repository->getAllCourses();
    }
    
    /**
     * createNewCourse
     *
     * @param  mixed $data
     * @return object
     */
    public function storeNewCourse(array $data)
    {
        return $this->repository->storeNewCourse($data);
    }
}