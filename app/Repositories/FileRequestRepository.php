<?php
namespace App\Repositories;

use App\Contracts\FileRequestRepositoryInterface;
use App\Http\Requests\FileRequestRequest;
use App\Mail\RequestFileMail;
use App\Models\Document;
use App\Models\FileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FileRequestRepository implements FileRequestRepositoryInterface
{
    protected $requester;
    protected $document;

    public function allFileRequests()
    {
        return FileRequest::all()->latest();
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
        $departmentId = $request->validated()['department_id'];

        //dd($request->validated()['document_id']);
        $document = Document::where('id', $request->validated()['document_id'])->first();
        $this->document  = $document;

        $requester = User::where('id', $request->validated()['requester_id'])->first();
        $requester['role'] = 'requester';
        $this->requester = $requester;
        Mail::to($requester->email)->send(new RequestFileMail($document,$requester));

        $approvers = User::where('department_id', $departmentId)
            ->where('role_id','>=','2')->get();
        $approvers->map(function($approver){
            $approver['role'] = 'approver';
            $approver['requester'] = $this->requester;

            Mail::to($approver->email)->send(new RequestFileMail($this->document,$approver));
        });

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
