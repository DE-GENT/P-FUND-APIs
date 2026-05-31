<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'           => ['sometimes', 'string', 'max:255'],
            'description'     => ['sometimes', 'string', 'min:20'],
            'category'        => ['sometimes', 'string', Rule::in(Project::CATEGORIES)],
            'budget_amount'   => ['sometimes', 'numeric', 'min:0'],
            'budget_currency' => ['sometimes', 'string', 'size:3'],
        ];
    }
}
