<?php

namespace App\Repositories;

use App\Models\Lesson;
use Illuminate\Support\Facades\Cache;

class LessonRepository
{
    protected $entity;
    
    /**
     * __construct
     *
     * @param  mixed $lesson
     * @return void
     */
    public function __construct(Lesson $lesson)
    {
        $this->entity = $lesson;
    }
    
    /**
     * getLessonsModule
     *
     * @param  mixed $module_id
     * @return collectionn
     */
    public function getLessonsModule(int $module_id)
    {
        return $this->entity
                        ->where('module_id', $module_id)
                        ->get();
    }
    
    /**
     * createNewLesson
     *
     * @param  mixed $moduleId
     * @param  mixed $data
     * @return object
     */
    public function createNewLesson(int $moduleId, array $data)
    {
        $data['module_id'] = $moduleId;

        Cache::forget('courses');

        return $this->entity->create($data);
    }
    
    /**
     * getLessonByModule
     *
     * @param  mixed $module_id
     * @param  mixed $lesson_uuid
     * @return object
     */
    public function getLessonByModule(int $module_id, string $lesson_uuid)
    {
        return $this->entity
                    ->where('module_id', $module_id)
                    ->where('uuid', $lesson_uuid)
                    ->firstOrfail();
    }
    
    /**
     * getLessonByUuid
     *
     * @param  mixed $lesson_uuid
     * @return object
     */
    public function getLessonByUuid(string $lesson_uuid)
    {
        return $this->entity
                    ->where('uuid', $lesson_uuid)
                    ->firstOrfail();
    }
    
    /**
     * updateLessonByUuid
     *
     * @param  mixed $module_id
     * @param  mixed $lesson_uuid
     * @param  mixed $data
     * @return object
     */
    public function updateLessonByUuid(int $module_id, string $lesson_uuid, array $data)
    {
        $lesson = $this->getLessonByUuid($lesson_uuid);

        $data['module_id'] = $module_id;

        Cache::forget('courses');

        return $lesson->update($data);
    }
    
    /**
     * deleteLessonByUuid
     *
     * @param  mixed $lesson_uuid
     * @return object
     */
    public function deleteLessonByUuid(string $lesson_uuid)
    {
        $lesson = $this->getLessonByUuid($lesson_uuid);

        Cache::forget('courses');

        return $lesson->delete();
    }
}
