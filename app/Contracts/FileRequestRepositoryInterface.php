<?php

namespace App\Contracts;


use App\Http\Requests\FileRequestRequest;
use App\Models\FileRequest;

interface FileRequestRepositoryInterface
{
    public function allFileRequests();

    public function showFileRequest($id);

    public function fetchUserFileRequests($userId);

    public function createFileRequest(FileRequestRequest $request);

    public function updateFileRequest(FileRequestRequest $request, FileRequest $fileRequest);

    public function deleteFileRequest(FileRequest $fileRequest);
}
