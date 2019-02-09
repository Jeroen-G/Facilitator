<?php

namespace JeroenG\Facilitator\Tests\Unit;

use Illuminate\Support\Collection;
use JeroenG\Facilitator\Element;
use JeroenG\Facilitator\Manager;
use JeroenG\Facilitator\Tests\TestCase;
use JeroenG\Facilitator\Tests\Fixtures\Models\Task as TaskModel;
use JeroenG\Facilitator\Tests\Fixtures\Facilities\Task as TaskFacility;
use JeroenG\Facilitator\Tests\Fixtures\Requests\FacilityRequest;

class FacilityTest extends TestCase
{
    /**
     * The subset of fillables the Fixture model has.
     * Kept here in case it changes in the future.
     *
     * @var array
     */
    public $subset = ['title', 'content', 'checked'];

    public function test_fetching_model()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);
        $this->assertTrue($fy->model() instanceof TaskModel);
    }

    public function test_fetching_fillables()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);
        $this->assertTrue($fy->fillables() instanceof Collection);
        $this->assertArraySubset($this->subset, $fy->fillables());
    }

    public function test_has_custom_fields()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);
        $this->assertTrue($fy->hasFieldFor('checked'));
    }

    public function test_building_form()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);
        $form = $fy->buildForm();
        $this->assertTrue($form instanceof Collection);
        $this->assertCount(4, $form);
        $form->each(function ($element) {
            $this->assertTrue($element instanceof Element);
            $this->assertArrayHasKey('type', $element->toArray());
            $this->assertArrayHasKey('name', $element->toArray());
            $this->assertArrayHasKey('view', $element->toArray());
        });
    }

    public function test_creating_html()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);

        $fy->buildForm()->each(function ($element) {
            $this->assertNotNull($element->toHtml());
        });
    }

    public function test_has_a_form_request()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);

        $this->assertFalse($fy->hasFormRequest());

        $fy->formRequest = FacilityRequest::class;

        $this->assertTrue($fy->hasFormRequest());
    }

    public function test_get_a_form_request()
    {
        $fy = app(Manager::class)->resolve(TaskFacility::class);
        $fy->formRequest = FacilityRequest::class;

        $this->assertEquals(FacilityRequest::class, $fy->getFormRequest());
    }
}
