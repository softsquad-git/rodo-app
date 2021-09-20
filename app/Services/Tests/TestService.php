<?php

namespace App\Services\Tests;

use App\Models\Tests\Test;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestService
{
    /**
     * @param array $data
     * @param Test|null $test
     * @return Test
     * @throws Exception
     */
    public function save(array $data, Test $test = null): Test
    {
        if ($test) {

        }

        DB::beginTransaction();
        try {
            $data['number'] = Str::random(4);
            $data['number_questions'] = count($data['questions']);
            /**
             * @var Test $test
             */
            $test = Test::create($data);
            $test->questions()->sync($data['questions']);

            DB::commit();
            return $test;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param Test $test
     * @return bool|null
     */
    public function remove(Test $test): ?bool
    {
        return $test->delete();
    }
}
