<?php

namespace App\Services\Tests;

use App\Interfaces\MailInterface;
use App\Models\Employees\EmployeeCertificate;
use App\Models\Tests\Test;
use App\Models\Tests\TestQuestionAnswer;
use App\Models\Users\User;
use App\Traits\GenerateNumber;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestService
{
    use GenerateNumber;

    public function __construct(
        private MailInterface $mail
    )
    {
    }

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
            $data['number'] = $this->generateRandomNumber();
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

    /**
     * @param array $departmentIds
     * @param Test $test
     * @return Test
     */
    public function assignDepartmentTest(array $departmentIds, Test $test): Test
    {
        $test->departments()->sync($departmentIds);

        return $test;
    }

    /**
     * @param array $data
     * @param Test $test
     * @return bool
     * @throws Exception
     */
    public function complete(array $data, Test $test): bool
    {
        $countTestQuestions = $test->questions()->count();
        $answersIds = [];
        foreach ($data['answers'] as $answers) {
            foreach ($answers as $answer) {
                $answersIds[] = $answer;
            }
        }

        $answers = TestQuestionAnswer::whereIn('id', $answersIds)->get();

        $positiveAnswers = [];

        foreach ($answers as $answer) {
            if ($answer->is_true) {
                $positiveAnswers[] = $answer->id;
            }
        }

        $countPositiveAnswers = count($positiveAnswers);

        $percent = $this->getPercentage($countTestQuestions, $countPositiveAnswers);

        if ($percent < $test->pass_threshold) {
            return false;
        }

        DB::beginTransaction();
        try {
            $this->saveCertificate($test);

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param $total
     * @param $number
     * @return float|int
     */
    protected function getPercentage($total, $number): float|int
    {
        if ( $total > 0 ) {
            return round(($number * 100) / $total, 2);
        } else {
            return 0;
        }
    }

    /**
     * @param Test $test
     * @return bool
     */
    protected function saveCertificate(Test $test): bool
    {
        /**
         * @var User $user
         */
        $user = Auth::user();

        if (!$user->employee) {
            return false;
        }

        $certificates = $test->certificates;
        foreach ($certificates as $certificate) {
            EmployeeCertificate::create([
                'number' => Str::random(3),
                'test_id' => $test->id,
                'certificate_pattern_id' => $certificate->id,
                'employee_id' => $user->employee->id,
                'client_id' => $user->employee->client_id,
                'test_date' => Carbon::now(),
                'release_date' => Carbon::now()
            ]);
        }

        return true;
    }


}
