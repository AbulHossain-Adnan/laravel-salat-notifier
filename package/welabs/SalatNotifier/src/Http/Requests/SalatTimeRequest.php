<?php

namespace welabs\SalatNotifier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalatTimeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'salat' => [
                'required',
                'string',
                'in:Fajr,Dhuhr,Asr,Maghrib,Isha',
               'unique:salat_times,salat,' . ($this->salat_time->id ?? 'null'),
            ],
            'time' => 'required|date_format:H:i',
        ];
    }

    public function messages(): array
    {
        return [
            'salat.required' => 'The Salat name is required.',
            'salat.in' => 'Please select a valid Salat name (Fajr, Dhuhr, Asr, Maghrib, Isha).',
            'time.required' => 'The time is required.',
            'time.date_format' => 'The time must be in the format HH:MM.',
        ];
    }
}
