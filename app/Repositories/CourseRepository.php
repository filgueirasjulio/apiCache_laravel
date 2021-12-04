<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{    
    protected $entity;
    /**
     * __construct
     *
     * @param  mixed $courseService
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->entity = $course;
    }
            
    /**
     * getAllCourses
     *
     * @return collection
     */
    public function getAllCourses()
    {
        return $this->entity->get();
    }

    public function storeNewCourse(array $data)
    {
        return $this->entity->create($data);
    }
}