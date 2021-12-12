<?php

namespace Tests\Feature\Api;

use App\Models\Course;
use App\Models\Module;
use Tests\TestCase;

class ModuleTest extends TestCase
{
    public $course;
    public $module;

    protected function setUp(): void
    {  
        parent::setUp();
        
        $this->course = Course::factory()->create();

        $this->module = Module::factory()->create([
            'course_id' => $this->course->id
        ]);

        Module::factory()->count(9)->create([
            'course_id' => $this->course->id
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_modules_by_course()
    {
        $response = $this->getJson("api/courses/{$this->course->uuid}/modules");

        $response->assertStatus(200)
                    ->assertJsonCount(10, 'data');
    }

    public function test_notfound_modules_by_course()
    {
        $response = $this->getJson('api/courses/fake_value/modules');

        $response->assertStatus(404);
    }

    public function test_get_module_by_course()
    {
        $response = $this->getJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_module_by_course()
    {
        $response = $this->postJson("api/courses/{$this->course->uuid}/modules", []);

        $response->assertStatus(422);
    }

    public function test_create_module_by_course()
    {
        $response = $this->postJson("api/courses/{$this->course->uuid}/modules", [
            'name' => 'Módulo 01',
        ]);

        $response->assertStatus(201);
    }

    public function test_validations_update_module_by_course()
    {
        $response = $this->putJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}", []);

        $response->assertStatus(422);
    }


    public function test_update_module_by_course()
    {
        $response = $this->putJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}", [
            'course' => $this->course->uuid,
            'name' => 'Módulo Updated',
        ]);

        $response->assertStatus(200);
    }

    public function test_notfound_delete_module_by_course()
    {
        $response = $this->deleteJson("api/courses/{$this->course->uuid}/modules/fake_module");

        $response->assertStatus(404);
    }

    public function test_delete_module_by_course()
    {
        $response = $this->deleteJson("api/courses/{$this->course->uuid}/modules/{$this->module->uuid}");

        $response->assertStatus(204);
    }
}