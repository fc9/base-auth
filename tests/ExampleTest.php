<?php

namespace Fc9\Auth\Tests;

use Orchestra\Testbench\TestCase;
use Fc9\Auth\Providers\AuthServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [AuthServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
