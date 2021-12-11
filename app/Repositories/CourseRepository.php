<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Cache;

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
       return Cache::remember('courses', 60*60, function () {

            return $this->entity
            ->with('modules.lessons')
            ->get(); 
        });
    }
    
    /**
     * storeNewCourse
     *
     * @param  mixed $data
     * @return object
     */
    public function storeNewCourse(array $data)
    {
        Cache::forget('courses');
        
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
        $query = $this->entity->where('uuid', $course_uuid);

        if($loadRelationShip) {
            $query->with('modules.lessons');
        }
               
        return $query->firstOrFail();
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
      
        Cache::forget('courses');
        
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

        Cache::forget('courses');

        return $course->delete();
    }
}