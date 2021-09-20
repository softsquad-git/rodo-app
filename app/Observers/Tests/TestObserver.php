<?php

namespace App\Observers\Tests;

use App\Models\Tests\Test;

class TestObserver
{
    /**
     * @param Test $test
     */
    public function deleted(Test $test)
    {
        $test->certificates()->detach();
        $test->questions()->detach();
    }
}
