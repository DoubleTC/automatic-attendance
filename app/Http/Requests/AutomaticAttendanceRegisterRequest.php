<?php

namespace App\Http\Requests;

use App\Http\Controllers\CommonsController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutomaticAttendanceRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'access_token' => [
                'required',
                'max:50',
                'string',
                function($attribute, $value, $fail) {
                    if (is_string($value)) {
                        try {
                            $response = Http::withToken($this->input('access_token'))->get(env('MATTERMOST_API_URL') . '/users/me');
                        } catch (\Exception $exception) {
                            Log::error($exception->getMessage());
                            $fail('Connection failed to Mattermost api.');
                            return;
                        }

                        if ($response->status() === JsonResponse::HTTP_UNAUTHORIZED) {
                            $fail('The access token is invalid or expired');
                            return;
                        }
                    }
                }
            ],
            'channel_id' => [
                'required',
                'max:50',
                'string',
                function($attribute, $value, $fail) {
                    if (is_string($value)) {
                        try {
                            $response = Http::withToken($this->input('access_token'))->get(env('MATTERMOST_API_URL') . '/channels/' . $value);
                        } catch (\Exception $exception) {
                            Log::error($exception->getMessage());
                            $fail('Connection failed to Mattermost api.');
                            return;
                        }

                        if ($response->status() !== JsonResponse::HTTP_OK) {
                            $fail('The channel id is not found');
                            return;
                        }
                    }
                }
            ],
            'email' => 'required|email|max:100',
            'message' => 'required|max:200',
            'send_at_time' => [
                'required',
                'string',
                function($attribute, $value, $fail) {
                    if (is_string($value)) {
                        $explodeTime = explode(':', $value);

                        if (count($explodeTime) !== 2
                            || (!empty($explodeTime[0]) && ($explodeTime[0] < 0 || $explodeTime[0] > 24))
                            || (!empty($explodeTime[1]) && ($explodeTime[1] < 0 || $explodeTime[1] > 60))
                        ) {
                            $fail('The send at time is invalid');
                            return;
                        }
                    }
                }
            ],
            'monday' => 'in:0,1',
            'tuesday' => 'in:0,1',
            'wednesday' => 'in:0,1',
            'thursday' => 'in:0,1',
            'friday' => 'in:0,1',
            'saturday' => 'in:0,1',
            'sunday' => 'in:0,1',
        ];
    }
}
