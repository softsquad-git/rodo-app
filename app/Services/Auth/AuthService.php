<?php

namespace App\Services\Auth;

use App\Interfaces\LogInterface;
use App\Interfaces\MailInterface;
use App\Models\Users\User;
use App\Services\Log\LogService;
use App\Traits\VerificationTrait;
use Illuminate\Support\Facades\DB;
use \Exception;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use VerificationTrait;

    /**
     * @param LogInterface $log
     * @param MailInterface $mail
     */
    public function __construct(
        private LogInterface $log,
        private MailInterface $mail
    )
    {
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function register(array $data): User
    {
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $token = $this->generateToken(20);

            /**
             * @var User $user
             */
            $user = User::create($data);

            $this->saveToken($token, $user->email);

            # Send email to user
            $this->mail
                ->setTo($user->email)
                ->setFrom(config('mail.from.address'))
                ->setTemplate('auth.register.verification')
                ->setSubject(__('mail.subjects.register_verification_email'))
                ->setBody([
                    'token' => $token,
                    'user' => $user
                ])
                ->send();

            DB::commit();
            return $user;
        }catch (Exception $e) {
            DB::rollBack();

            #save log
            $this->log
                ->setCode($e->getCode())
                ->setMessage($e->getMessage())
                ->setType(LogService::$types['ERROR'])
                ->setAction(LogService::$actions['REGISTER']);

            throw new Exception($e->getMessage());
        }
    }
}
