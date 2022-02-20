<?php

namespace App\Contracts;


use App\Http\Requests\FileRequestRequest;
use App\Models\FileRequest;
use Illuminate\Http\Request;

interface FileRequestRepositoryInterface
{
    public function allFileRequests();

    public function showFileRequest($id);

    public function fetchUserFileRequests($userId);

    public function fetchDepartmentFileRequests($departmentId);

    public function createFileRequest(FileRequestRequest $request);

    public function updateFileRequest(Request $request, FileRequest $fileRequest);

    public function deleteFileRequest(FileRequest $fileRequest);
}
