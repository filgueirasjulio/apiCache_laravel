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
     * getCourse
     *
     * @return object
     */
    public function getCourse(string $identify)
    {
        return $this->repository->getCourseByUuid($identify);
    }
     
    /**
     * storeNewCourse
     *
     * @param  mixed $data
     * @return object
     */
    public function storeNewCourse(array $data)
    {
        return $this->repository->storeNewCourse($data);
    }
   
    /**
     * updateNewCourse
     *
     * @param  mixed $data
     * @return object
     */
    public function updateCourse(string $identify, array $data)
    {
        return $this->repository->updateCourseByUuid($identify, $data);
    }

    /**
     * getDelete
     *
     */
    public function deleteCourse(string $identify)
    {
        return $this->repository->deleteCourseByUuid($identify);
    }
    
}