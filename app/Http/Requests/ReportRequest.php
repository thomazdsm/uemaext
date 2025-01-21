<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'project_id' => ['required', 'exists:projects,id'],
            'description' => ['required', 'string'],
            'status_id' => ['required', 'exists:statuses,id'],
        ];
    }
}
