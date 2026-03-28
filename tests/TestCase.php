<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }
}
