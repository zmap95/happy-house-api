<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Reset password request",
 *      description="Reset password body data",
 *      type="object",
 *      required={"email", "token", "password", "password_confirmed"}
 * )
 */
class UserResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @OA\Property(
     *      property="email",
     *      title="email",
     *      description="email of user",
     *      example="user@gmail.com"
     * )
     * @OA\Property(
     *      property="token",
     *      title="token",
     *      description="token reset",
     *      example="efgjej3$deeddd"
     * )
     * @OA\Property(
     *      property="password",
     *      title="password",
     *      description="new password",
     *      example="password"
     * )
     * @OA\Property(
     *      property="password_confirmation",
     *      title="password_confirmation",
     *      description="password confirmation",
     *      example="password"
     * )
     */
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ];
    }
}
