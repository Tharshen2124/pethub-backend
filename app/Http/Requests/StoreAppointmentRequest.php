<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'pet_id' => 'required',
            'pet_service_provider_ref' => 'required',
            'appointment_type' => 'required',
            'date' => 'required',
            'time' => 'required',
            'important_details' => 'required',
            'issue_description' => 'required',
        ];
    }
}
