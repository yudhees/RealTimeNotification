<?php

namespace App\Jobs;

use App\Events\FormProcessed;
use App\Models\FormNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

use Pusher\Pusher;
use function Laravel\Prompts\error;

class ProcessFormJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $userId,public array $data)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        sleep(5);
        try {
            $form=FormNotification::create($this->data);
            event(new FormProcessed($this->userId, ['created_at'=>now()->toDateTimeString(),'id'=>$form->id]));
            info('Job Processed Successfully');
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
