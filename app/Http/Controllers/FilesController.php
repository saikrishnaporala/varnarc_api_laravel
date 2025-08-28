<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileModel;
use App\Http\Resources\FileResource;

/**
 * @OA\Tag(
 *     name="Files",
 *     description="API Endpoints for file uploads"
 * )
 */
class FilesController extends Controller
{
    /**
     * Upload a file for a specific entity
     *
     * @OA\Post(
     *     path="/files/upload/{id}",
     *     tags={"Files"},
     *     summary="Upload a file",
     *     description="Upload a file for a given entity ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the entity to attach the file",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="binary",
     *                     description="The file to upload"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="File uploaded successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="entity_id", type="integer"),
     *                 @OA\Property(property="path", type="string"),
     *                 @OA\Property(property="original_name", type="string"),
     *                 @OA\Property(property="mime", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No file uploaded",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string")
     *         )
     *     )
     * )
     */
    public function upload(Request $request, $id)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        $file = $request->file('file');
        $path = $file->store('uploads');
        $fileModel = FileModel::create([
            'entity_id' => $id,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime' => $file->getMimeType(),
        ]);
        return new FileResource($fileModel);
    }
}
