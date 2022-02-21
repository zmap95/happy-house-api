<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Change password request",
 *      description="Change password body data",
 *      type="object",
 *      required={"current_password", "new_password"}
 * )
 */
class UserChangePasswordRequest extends FormRequest
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
     * @OA\Property(property="current_password", type="string", example="password")
     * @OA\Property(property="new_password", type="string", example="password")
     */
    public function rules()
    {
        return [
            'current_password' => 'required|min:8|max:200',
            'new_password' => 'required|min:8|max:200',
        ];
    }
}
