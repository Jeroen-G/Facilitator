<?php

namespace JeroenG\Facilitator\Tests\Feature;

use JeroenG\Facilitator\Tests\TestCase;
use JeroenG\Facilitator\Tests\Fixtures\Requests\FacilityRequest;

class ControllerTest extends TestCase
{
    public function test_index_is_shown()
    {
        $this->decorate();

        $this->get(route('facilitator::index'))
             ->assertStatus(200);
    }

    public function test_form_request_binding_with_request_defined()
    {
        $task = $this->taskWithRequest();
        $this->assertTrue($task->getFacility()->hasFormRequest());

        $this->get(route('facilitator::index'))
             ->assertStatus(200);
    }

    public function test_facility_show()
    {
        $task = $this->task();

        $this->get(route('facilitator::facilities.show', ['task', $task->id]))
            ->assertStatus(200);
    }

    public function test_facility_form_is_shown()
    {
        $task = $this->task();

        $this->get(route('facilitator::facilities.create', 'task'))
             ->assertStatus(200);

        $this->get(route('facilitator::facilities.edit', 'task'))
            ->assertStatus(200);
    }

    public function test_facility_form_is_submitted()
    {
        $task = $this->task();

        $this->post(route('facilitator::facilities.store', 'task'), [
            'title' => 'Checked off!',
            'content' => 'All done!',
            'checked' => true,
        ])
            ->assertStatus(200);
    }

    public function test_facility_form_is_submitted_with_custom_request()
    {
        $this->assertIsCalled(FacilityRequest::class, function () {
            $task = $this->taskWithRequest();

            $this->post(route('facilitator::facilities.store', 'taskwithrequest'), [
                'title' => 'Checked off!',
                'content' => 'All done!',
                'checked' => true,
            ])->assertStatus(200);
        });
    }

    public function test_facility_form_is_updated()
    {
        $task = $this->task();

        $this->put(route('facilitator::facilities.edit', 'task'), [
            'title' => 'Checked off!',
            'content' => 'All done!',
            'checked' => true,
        ])
            ->assertStatus(200);
    }

    public function test_facility_form_is_updated_with_custom_request()
    {
        $this->assertIsCalled(FacilityRequest::class, function () {
            $task = $this->taskWithRequest();

            $this->put(route('facilitator::facilities.update', 'taskwithrequest'), [
                'title' => 'Checked off!',
                'content' => 'All done!',
                'checked' => true,
            ])->assertStatus(200);
        });
    }
}
