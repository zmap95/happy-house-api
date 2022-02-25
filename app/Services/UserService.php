<?php

namespace App\Services;

use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService extends BaseService {

    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function findByPhoneOrEmail($phoneOrEmail) {
        return $this->repository->findByPhoneOrEmail($phoneOrEmail);
    }

    public function register(array $dataRegister) {
        $dataRegister['password'] = bcrypt($dataRegister['password']);
        $dataRegister['status'] = 'active';

        return $this->repository->create($dataRegister);
    }

    public function forgotPassword($phone) {
        $user = $this->repository->findFirst(['phone' => $phone]);
        $password = $this->generateRandomString();
        $this->repository->update(['password' => bcrypt($password)], $user->id);

        return $password;
    }

    public function changePassword(string $currentPassword, string $newPassword) {
        if (!Hash::check($currentPassword, auth()->user()->password)) {
            throw ValidationException::withMessages(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }

        $this->repository->update(['password' => bcrypt($newPassword)], auth()->user()->id);
    }

    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}
