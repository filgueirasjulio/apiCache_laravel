<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $repository;
    
    /**
     * __construct
     *
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
    public function getCourse(string $course_uuid)
    {
        return $this->repository->getCourseByUuid($course_uuid);
    }
     
    /**
     * storeNewCourse
     * 
     * @return object
     */
    public function storeNewCourse(array $data)
    {
        return $this->repository->storeNewCourse($data);
    }
   
    /**
     * updateNewCourse
     * 
     * @return object
     */
    public function updateCourse(string $course_uuid, array $data)
    {
        return $this->repository->updateCourseByUuid($course_uuid, $data);
    }

    /**
     * getDelete
     * 
     * @return object
     */
    public function deleteCourse(string $course_uuid)
    {
        return $this->repository->deleteCourseByUuid($course_uuid);
    }
    
}