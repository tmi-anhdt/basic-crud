<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        if (!Auth::user()) return false;
        return true;
    }

    public function rules(): array
    {
        return [
            'hidden_id' => 'bail|required',
            'content'    => 'bail|required',
            'status'     => 'bail|required',
        ];
    }
}