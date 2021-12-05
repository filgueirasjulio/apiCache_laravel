<?php

namespace App\Services;

use App\Repositories\{
    LessonRepository,
    ModuleRepository
};

class LessonService
{
    protected $lessonRepository, $moduleRepository;
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct(
        LessonRepository $lessonRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->lessonRepository = $lessonRepository;
        $this->moduleRepository = $moduleRepository;
    }
    
    /**
     * getLessonsByModule
     *
     * @param  mixed $module_uuid
     * @return object
     */
    public function getLessonsByModule(string $module_uuid)
    {
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->getLessonsModule($module->id);
    }
    
    /**
     * createNewLesson
     *
     * @param  mixed $data
     * @return object
     */
    public function createNewLesson(array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->createNewLesson($module->id, $data);
    }
    
    /**
     * getLessonByModule
     *
     * @param  mixed $module_uuid
     * @param  mixed $lesson_uuid
     * @return object
     */
    public function getLessonByModule(string $module_uuid, string $lesson_uuid)
    {
        $module = $this->moduleRepository->getModuleByUuid($module_uuid);

        return $this->lessonRepository->getLessonByModule($module->id, $lesson_uuid);
    }
    
    /**
     * updateLesson
     *
     * @param  mixed $lesson_uuid
     * @param  mixed $data
     * @return object
     */
    public function updateLesson(string $lesson_uuid, array $data)
    {
        $module = $this->moduleRepository->getModuleByUuid($data['module']);

        return $this->lessonRepository->updateLessonByUuid($module->id, $lesson_uuid, $data);
    }
    
    /**
     * deleteLesson
     *
     * @param  mixed $lesson_uuid
     * @return object
     */
    public function deleteLesson(string $lesson_uuid)
    {
        return $this->lessonRepository->deleteLessonByUuid($lesson_uuid);
    }
}