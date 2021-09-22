<?php

namespace App\Services\Users;

use App\Helpers\Role;
use App\Interfaces\MailInterface;
use App\Models\Users\User;
use App\Traits\UploadFileTrait;
use \Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    use UploadFileTrait;

    public function __construct(
        private MailInterface $mail
    )
    {
    }

    /**
     * @param array $data
     * @param User $user
     * @return User
     * @throws Exception
     */
    public function updateAvatar(array $data, User $user): User
    {
        $user->update([
            'avatar_img' => $this->uploadSingleFile($data['avatar'], User::$avatarDir)
        ]);

        return $user;
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function create(array $data): User
    {
        DB::beginTransaction();
        try {
            $generatePassword = null;
            if ($data['role'] == Role::$role['EMPLOYEE']) {
                $generatePassword = Str::random(8);
                $data['password'] = Hash::make($generatePassword);
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            /**
             * @var User $user
             */
            $user = User::create($data);

//            $this->mail
//                ->setTo($user->email)
//                ->setSubject(__('_mail.title.user_account_created'))
//                ->setFrom(config('mail.from'))
//                ->setTemplate('user.create_account.'.$user->role)
//                ->setBody([
//                    'generate_password' => $generatePassword,
//                    'user' => $user
//                ])
//                ->send();

            DB::commit();
            return $user;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function update(array $data, User $user): User
    {

    }


    public function remove(User $user): ?bool
    {
        return $user->delete();
    }

    /**
     * @param array $data
     * @param User $user
     * @return User|bool
     */
    public function updatePassword(array $data, User $user): User|bool
    {
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update(['password' => Hash::make($data['new_password'])]);

            return $user;
        }

        return false;
    }

    /**
     * @param array $data
     * @param User $user
     * @return User
     */
    public function updateBasicData(array $data, User $user): User
    {
        $user->update($data);

        return $user;
    }
}

/**TODO
 * Wiadomośći email
 * Właściwe adnotacje
 */
