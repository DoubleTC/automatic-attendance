<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\JsonResponse;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutomaticAttendanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $atm;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($atm)
    {
        $this->atm = $atm;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withToken($this->atm->access_token)
            ->post(env('MATTERMOST_API_URL') . '/posts?set_online=true', [
                'channel_id' => $this->atm->channel_id,
                'message' => $this->atm->message
            ]);

        if ($response->status() === JsonResponse::HTTP_UNAUTHORIZED) {
            Log::error('Access token: ' . $this->atm->access_token . ' is invalid or expired');
        }

        if ($response->status() === JsonResponse::HTTP_FORBIDDEN) {
            Log::error('Channel id: ' . $this->atm->channel_id . ' is not found');
        }
    }
}
