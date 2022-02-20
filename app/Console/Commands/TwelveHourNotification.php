<?php

namespace App\Console\Commands;

use App\Mail\CyDocsMail;
use App\Models\FileRequest;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TwelveHourNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:twelvehoursupdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification 12 hours before file access expiry';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
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

            if ($diff==12){
                Mail::to($approver->email)->send(new CyDocsMail($document,$approver));
                Mail::to($requester->email)->send(new CyDocsMail($document,$requester));
            }


        });
    }
}
