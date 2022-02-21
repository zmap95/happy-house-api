<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Login request",
 *      description="Login body data",
 *      type="object",
 *      required={"username", "password"}
 * )
 */
class UserLoginRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="username",
     *      description="Username or phone of user",
     *      example="user@gmail.com"
     * )
     *
     * @var string
     */
    public $username;

    /**
     * @OA\Property(
     *      title="password",
     *      description="Password",
     *      example="password"
     * )
     *
     * @var string
     */
    public $password;

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
            'username' => 'required',
            'password' => 'required|min:8|max:200',
        ];
    }
}
