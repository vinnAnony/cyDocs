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
        return FileRequest::where('id', '=', $id)
            ->with('requester')
            ->with('document')
            ->first();
    }

    public function fetchUserFileRequests($userId)
    {
        return FileRequest::where('requester_id', $userId)
            ->with('category')
            ->with('department')
            ->with('document')->get();
    }

    public function createFileRequest(FileRequestRequest $request)
    {
        return FileRequest::create($request->all());
    }

    public function updateFileRequest(Request $request, FileRequest $fileRequest)
    {
        $request['expires_at'] = date('Y-m-d H:i:s', strtotime($request['expires_at']));
        return $fileRequest->update($request->all());
    }

    public function deleteFileRequest(FileRequest $fileRequest)
    {
        /** @var TYPE_NAME $fileRequest */
        return $fileRequest->delete($fileRequest);
    }

    public function fetchDepartmentFileRequests($departmentId)
    {
        return FileRequest::where('department_id', $departmentId)
            ->with('requester')
            ->with('document')->get();
    }
}
