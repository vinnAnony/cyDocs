<?php
namespace App\Repositories;

use App\Console\Commands\TwelveHourNotification;
use App\Contracts\DepartmentRepositoryInterface;
use App\Http\Requests\DepartmentRequest;
use App\Mail\CyDocsMail;
use App\Models\Department;
use App\Models\FileRequest;
use App\Notifications\TwelveHourEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DepartmentRepository implements DepartmentRepositoryInterface
{

    public function allDepartments()
    {
        $timeNow = Carbon::parse(Carbon::now())->toDateTimeString();
        $fileRequests = FileRequest::where('status',2)
            ->where('expires_at','>',$timeNow)
            ->with('document')
            ->with('requester')
            ->with('approver')
            ->get();
        $fileRequests->map(function($fileRequest){
            $dateTime = Carbon::parse($fileRequest->expires_at);

            $dateTimeNow = Carbon::now();
            $diff = $dateTime->diffInHours($dateTimeNow);
            $document = $fileRequest->document;
            $document['remainingHours'] = $diff;
            $requester = $fileRequest->requester;
            $requester['role'] = 'requester';
            $approver = $fileRequest->approver;
            $approver['role'] = 'approver';
            $approver['requester'] = $fileRequest->requester;

            dd(json_encode($document['remainingHours']));

            Mail::to($approver->email)->send(new CyDocsMail($document,$approver));
            Mail::to($requester->email)->send(new CyDocsMail($document,$requester));

        });

        return Department::all();
    }

    public function showDepartment($id)
    {
        return Department::where('id', '=', $id)->first();
    }

    public function createDepartment(DepartmentRequest $request)
    {
        return Department::create($request->all());
    }

    public function updateDepartment(DepartmentRequest $request, Department $department)
    {
         return $department->update($request->all());
    }

    public function deleteDepartment(Department $department)
    {
        /** @var TYPE_NAME $department */
        return $department->delete($department);
    }

    public function fetchDepartmentDocuments($id)
    {
        return Department::where('id', $id)->with('documents')->get();
    }
}
