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
        return $this->entity
                    ->with('modules.lessons')
                    ->get();
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
     * @param  mixed $course_uuid
     * @return object
     */
    public function getCourseByUuid(string $course_uuid, bool $loadRelationShip = true)
    {
        return $this->entity
                ->with($loadRelationShip ? 'modules.lessons' : '')
                ->where('uuid', $course_uuid)->firstOrFail();
    }
    
    /**
     * updateCourseByUuid
     *
     * @param  mixed $course_uuid
     * @param  mixed $data
     * @return void
     */
    public function updateCourseByUuid(string $course_uuid, array $data)
    {
        $course = $this->getCourseByUuid($course_uuid, false);
      
        return $course->update($data);
    }

    /**
     * deleteCourseByUuid
     *
     * @param  mixed $course_uuid
     */
    public function deleteCourseByUuid(string $course_uuid)
    {
        $course = $this->getCourseByUuid($course_uuid, false);

        return $course->delete();
    }
}