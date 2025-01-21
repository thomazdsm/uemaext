<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true; // A autorização já é feita pela Policy
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'date|after:start_date',
            'status_id' => 'required|exists:status,id',
            'type_id' => 'required|exists:types,id'
        ];
    }
}
