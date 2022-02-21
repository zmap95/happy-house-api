<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Forgot password request",
 *      description="Forgot password body data",
 *      type="object",
 *      required={"email"}
 * )
 */
class UserForgotPasswordRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="email",
     *      description="email of user",
     *      example="user@gmail.com"
     * )
     *
     * @var string
     */
    private $email;

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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|exists:users|max:200'
        ];
    }
}
