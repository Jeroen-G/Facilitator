<?php

namespace JeroenG\Facilitator\Tests;

use JeroenG\TestAssist\Assistants;
use JeroenG\Facilitator\Manager;
use JeroenG\Facilitator\Tests\Fixtures\Models\Task;
use JeroenG\Facilitator\Tests\Fixtures\Models\TaskWithRequest;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use Assistants;

    protected function getPackageProviders($app)
    {
        return ['JeroenG\Facilitator\FacilitatorServiceProvider'];
    }

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->withFactories(__DIR__.'/database/factories');

        // $this->artisan('migrate', ['--database' => 'testbench']);
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->make(Manager::class)->setNamespace('JeroenG\Facilitator\Tests\Fixtures\Facilities');
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    public function task()
    {
        return $this->create(Task::class);
    }

    public function taskWithRequest()
    {
        return $this->create(TaskWithRequest::class);
    }

    public function decorate()
    {
        $this->task();
    }
}
