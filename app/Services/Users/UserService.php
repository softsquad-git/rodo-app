<?php

namespace App\Services\Users;

use App\Models\Users\User;
use App\Traits\UploadFileTrait;
use \Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use UploadFileTrait;

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

    public function create(array $data): User
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function update(array $data, User $user): User
    {

    }


    public function remove(User $user): ?bool
    {
        return $user->delete();
    }
}

/**TODO
 * Wiadomośći email
 * Właściwe adnotacje
 */
