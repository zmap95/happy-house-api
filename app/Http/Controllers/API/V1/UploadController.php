<?php

namespace App\Http\Controllers\API\V1;

use App\Helps\ResponseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UploadFileRequest;
use App\Http\Requests\UploadMultipleFileRequest;
use App\Services\UploadService;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * @var UploadService
     */
    private $uploadService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    /**
     * @OA\Post(
     *     path="/upload",
     *      tags={"[Upload] Upload file"},
     *     description="Upload single file",
     *     summary="Upload single file",
     *     operationId="uploadFile",
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="file",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     * )
     * */
    public function upload(UploadFileRequest $request) {
        $path = $this->uploadService->upload('temporary', $request->file('file'));

        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Upload file thành công")
            ->setData([
                'path' => $path,
                'full_path' => url('storage' . $path),
            ])
            ->getBodyResponse();

        return response()->json($response);
    }

    /**
     * @OA\Post(
     *     path="/upload-multiple",
     *     tags={"[Upload] Upload file"},
     *     description="Upload multiple files",
     *     summary="Upload multiple files",
     *     operationId="uploadFile.multiple",
     *     security={ {"sanctum": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="files[]",
     *                     type="array",
     *                     @OA\Items(type="file", format="binary" )
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="successful operation",
     *     ),
     * )
     * */
    public function uploadMultiple(UploadMultipleFileRequest $request) {
        $paths = [];
        $files = $request->file('files');
        foreach ($files as $file) {
            $path = $this->uploadService->upload('temporary', $file);
            $paths[] = [
                'path' => $path,
                'full_path' => url('storage' . $path),
            ];
        }


        $response = (new ResponseData())->setStatus(true)
            ->setMessage("Upload file thành công")
            ->setData([
                'paths' => $paths
            ])
            ->getBodyResponse();

        return response()->json($response);
    }
}
