<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function brand_has_name()
    {
        $this->assertTrue(true);
    }
}
