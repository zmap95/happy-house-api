<?php

namespace App\Http\Controllers\API\V1;

use App\Helps\ResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserForgotPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Post(
     *      path="/user/login",
     *      operationId="login",
     *      tags={"[Chủ nhà][Authentication]"},
     *      summary="User login to system",
     *      description="Returns login data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/UserLoginRequest"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent()
     *      )
     * )
     */
    public function login(UserLoginRequest $request) {
        $response = (new ResponseData());
        $user = $this->userService->findByPhoneOrEmail($request->get('username'));

        if (!$user || $user->status != 'active') {
            $response = $response->setStatus(false)
                ->setMessage("Không tìm thấy tài khoản đăng nhập hoặc chưa được xác nhận")
                ->setData([])
                ->getBodyResponse();

            return response()->json($response, 422);
        }

        if (!Hash::check(trim($request->get('password')), $user->password)) {
            $response = $response->setStatus(false)
                ->setMessage("Mật khẩu không chính xác")
                ->setData([])
                ->getBodyResponse();

            return response()->json($response, 422);
        }

        $token = $user->createToken('token-name')->plainTextToken;

        $user->forceFill([
            'api_token' => $token,
        ])->save();

        $response = $response->setStatus(true)->setMessage("Đăng nhập thành công")->setData([
            'token' => $token,
            'user'  => new UserResource($user)
        ])->getBodyResponse();

        return response()->json($response);
    }

    /**
     * @OA\Post(
     *      path="/user/register",
     *      operationId="register",
     *      tags={"[Chủ nhà][Authentication]"},
     *      summary="User register to system",
     *      description="Returns register data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserRegisterRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function register(UserRegisterRequest $request) {
        DB::beginTransaction();
        try {
            $this->userService->register($request->validated());

            DB::commit();

            $response = (new ResponseData())->setStatus(true)
                ->setMessage("Đăng ký thành công, đang đợi admin phê duyệt")
                ->setData([])->getBodyResponse();

            return response()->json($response);
        } catch (\Exception $exception) {
            DB::rollBack();

            $response = (new ResponseData())->setStatus(false)
                ->setMessage("Đăng ký không thành công, lỗi hệ thống !!")
                ->getBodyResponse();

            return response()->json($response);
        }
    }

    /**
     * @OA\Post(
     *      path="/user/forgot-password",
     *      operationId="forgot-password",
     *      tags={"[Chủ nhà][Authentication]"},
     *      summary="User forgot password",
     *      description="Returns status forgot password",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserForgotPasswordRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function forgotPassword(UserForgotPasswordRequest $request) {
        $password = $this->userService->forgotPassword($request->get('phone'));

        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Hệ thống đã gửi mật khẩu mới đến số điện thoại đăng ký")
            ->setData(['password' => $password])
            ->getBodyResponse();

        return response()->json($response);
    }

    /**
     * @OA\Put(
     *      path="/user/change-password",
     *      operationId="change-password",
     *      tags={"[Chủ nhà][Authentication]"},
     *      summary="User change password",
     *      description="Returns status change password",
     *      security={ {"sanctum": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UserChangePasswordRequest")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function changePassword(UserChangePasswordRequest $request) {

        $this->userService->changePassword($request->current_password, $request->new_password);

        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Đổi mật khẩu thành công")
            ->getBodyResponse();

        return response()->json($response);
    }

    /**
     * @OA\Get(
     *      path="/user/profile",
     *      operationId="get-profile",
     *      tags={"[Chủ nhà][Authentication]"},
     *      summary="User get profile",
     *      description="Returns user profile",
     *      security={ {"sanctum": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function profile() {
        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Lấy thông tin thành công")
            ->setData(['user' => new UserResource(auth()->user())])
            ->getBodyResponse();

        return response()->json($response);
    }
}
