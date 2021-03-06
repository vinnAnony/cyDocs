<?php

namespace App\Http\Controllers\API;

use App\Contracts\FileRequestRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileRequestRequest;
use App\Models\FileRequest;
use Illuminate\Http\Request;

class FileRequestsController extends Controller
{
    protected $fileRequestRepo;

    public function __construct(FileRequestRepositoryInterface $fileRequestRepo)
    {
        $this->fileRequestRepo = $fileRequestRepo;
    }

    public function index()
    {
        $fileRequests = $this->fileRequestRepo->allFileRequests();
        return response()->json($fileRequests, 200);
    }

    public function store(FileRequestRequest $request)
    {
        $fileRequest = $this->fileRequestRepo->createFileRequest($request);

        return response()->json([
            'success' =>true,
            'message' => 'File request sent. Awaiting approval.'
        ], 201);
    }

    public function show($id)
    {
        $fileRequest = $this->fileRequestRepo->showFileRequest($id);
        return response()->json($fileRequest, 200);
    }

    public function update(Request $request, FileRequest $fileRequest)
    {
        $this->fileRequestRepo->updateFileRequest($request, $fileRequest);
        if ($request->status == 2){
            return response()->json([
                'success' =>true,
                'message' => 'File request approved.'
            ], 200);
        }elseif ($request->status == 3){
            return response()->json([
                'success' =>true,
                'message' => 'File request rejected.'
            ], 200);
        }

    }

    public function destroy(FileRequest $fileRequest)
    {
        $fileRequest = $this->fileRequestRepo->deleteFileRequest($fileRequest);
        return response()->json($fileRequest, 200);
    }

    public function fetchUserFileRequests($userId)
    {
        $response = $this->fileRequestRepo->fetchUserFileRequests($userId);

        return response()->json($response, 201);
    }

    public function fetchDepartmentFileRequests($departmentId)
    {
        $response = $this->fileRequestRepo->fetchDepartmentFileRequests($departmentId);

        return response()->json($response, 201);
    }
}
