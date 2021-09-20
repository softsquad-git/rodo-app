<?php

namespace App\Services\Tests;

use App\Models\Tests\TestQuestion;
use App\Models\Tests\TestQuestionAnswer;
use Illuminate\Support\Facades\DB;
use Exception;

class TestQuestionService
{
    /**
     * @param array $data
     * @param TestQuestion|null $testQuestion
     * @return TestQuestion
     * @throws Exception
     */
    public function save(array $data, TestQuestion $testQuestion = null): TestQuestion
    {
        if ($testQuestion) {

        }

        DB::beginTransaction();
        try {
            /**
             * @var TestQuestion $testQuestion
             */
            $testQuestion = TestQuestion::create(['name' => $data['name']]);

            foreach (json_decode($data['answers'], true) as $answer) {
                TestQuestionAnswer::create([
                    'test_question_id' => $testQuestion->id,
                    'name' => $answer['name'],
                    'is_true' => $answer['is_true']
                ]);
            }

            DB::commit();
            return $testQuestion;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param TestQuestion $testQuestion
     * @return bool|null
     */
    public function remove(TestQuestion $testQuestion): ?bool
    {
        return $testQuestion->delete();
    }
}
