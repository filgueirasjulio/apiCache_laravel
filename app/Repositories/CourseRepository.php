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
    
    /**
     * storeNewCourse
     *
     * @param  mixed $data
     * @return object
     */
    public function storeNewCourse(array $data)
    {
        return $this->entity->create($data);
    }
    
    /**
     * getCourseByUuid
     *
     * @param  mixed $identify
     * @return object
     */
    public function getCourseByUuid(string $identify)
    {
        return $this->entity->where('uuid', $identify)->firstOrFail();
    }
    
    /**
     * updateCourseByUuid
     *
     * @param  mixed $identify
     * @param  mixed $data
     * @return void
     */
    public function updateCourseByUuid(string $identify, array $data)
    {
        $course = $this->getCourseByUuid($identify);
      
        return $course->update($data);
    }

    /**
     * deleteCourseByUuid
     *
     * @param  mixed $identify
     */
    public function deleteCourseByUuid(string $identify)
    {
        $course = $this->getCourseByUuid($identify);

        return $course->delete();
    }
}