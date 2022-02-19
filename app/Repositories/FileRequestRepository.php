<?php
namespace App\Repositories;

use App\Contracts\FileRequestRepositoryInterface;
use App\Http\Requests\FileRequestRequest;
use App\Models\FileRequest;
use Illuminate\Http\Request;

class FileRequestRepository implements FileRequestRepositoryInterface
{

    public function allFileRequests()
    {
        return FileRequest::all();
    }

    public function showFileRequest($id)
    {
        return FileRequest::where('id', '=', $id)->first();
    }

    public function fetchUserFileRequests($userId)
    {
        return FileRequest::where('requester_id', '=', $userId)->first();
    }

    public function createFileRequest(FileRequestRequest $request)
    {
        return FileRequest::create($request->all());
    }

    public function updateFileRequest(FileRequestRequest $request, FileRequest $fileRequest)
    {
        return $fileRequest->update($request->all());
    }

    public function deleteFileRequest(FileRequest $fileRequest)
    {
        /** @var TYPE_NAME $fileRequest */
        return $fileRequest->delete($fileRequest);
    }
}
