<?php

namespace App\Services;

use App\Entities\User;
use App\Repositories\UserRepositoryEloquent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

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

    public function forgotPassword($email) {
        $user = $this->repository->findFirst(['email' => $email, 'status' => User::ACTIVE]);

        if (!$user) {
            throw ValidationException::withMessages(['email' => "Không tìm thấy người dùng với email yêu cầu"]);
        }

        $status = Password::sendResetLink(['email' => $email]);

        if ($status !== Password::RESET_LINK_SENT) {
            throw ValidationException::withMessages(['email' => __($status)]);
        }

        return true;
    }

    public function resetPassword(array $resetData) {
        $status = Password::reset(
            $resetData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw ValidationException::withMessages(['password' => 'Thông tin thiết lập lại mật khẩu không đúng, vui lòng thử lại']);
        }

        return true;
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
