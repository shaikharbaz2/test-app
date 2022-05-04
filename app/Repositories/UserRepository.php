<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository implements UserRepositoryInterface
{

    use FileUpload;

    public function deleteUser($orderId)
    {
        User::destroy($orderId);
    }

    public function createUser(array $userDetails)
    {
        $userDetails['image']    = $this->upload($userDetails['image']);
        $userDetails['password'] = Hash::make($userDetails['password']);
        $userDetails['token']    = Str::random(60);
        return User::create($userDetails);
    }

    public function updateUser($userId, array $newDetails)
    {
        unset($newDetails['_method']);
        if (isset($newDetails['image'])) {
            $newDetails['image'] = $this->upload($newDetails['image']);
        }
        return User::whereId($userId)->update($newDetails);
    }

}
