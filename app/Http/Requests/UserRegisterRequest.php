<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Register request",
 *      description="Register body data",
 *      type="object",
 *      required={"name", "phone", "email", "password", "location", "register_type"}
 * )
 */
class UserRegisterRequest extends FormRequest
{
    /**
     * @OA\Property(
     *      title="name",
     *      description="name of user",
     *      example="Nguyen van A"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *      title="phone",
     *      description="phone of user",
     *      example="09498487494"
     * )
     *
     * @var string
     */
    private $phone;

    /**
     * @OA\Property(
     *      title="email",
     *      description="email of user",
     *      example="xxxx@gmail.com"
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *      title="password",
     *      description="password of user",
     *      example="dfngker983"
     * )
     *
     * @var string
     */
    private $password;

    /**
     * @OA\Property(
     *      title="address",
     *      description="address of user",
     *      example="xóm 4 hải hâu"
     * )
     *
     * @var string
     */
    private $address;

    /**
     * @OA\Property(
     *      title="invite_code",
     *      description="invite_code of user",
     *      example="nmdf9g34nf"
     * )
     *
     * @var string
     */
    private $invite_code;

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
            'phone' => ['required', 'unique:users', 'max:11', 'regex:/[0-9]/'],
            'name' => ['required', 'max:200'],
            'email' => ['required', 'unique:users', 'max:200'],
            'password' => ['required', 'min:8', 'max:200'],
            'address' => ['nullable'],
            'invite_code' => ['nullable'],
        ];
    }
}
