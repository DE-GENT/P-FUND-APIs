<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Auth handled by middleware
    }

    public function rules(): array
    {
        return [
            'title'           => ['required', 'string', 'max:255'],
            'description'     => ['required', 'string', 'min:20'],
            'category'        => ['required', 'string', Rule::in(Project::CATEGORIES)],
            'budget_amount'   => ['required', 'numeric', 'min:0'],
            'budget_currency' => ['sometimes', 'string', 'size:3'],
            'documents'       => ['sometimes', 'array', 'max:5'],
            'documents.*'     => ['file', 'mimes:pdf,doc,docx,jpg,jpeg,png,xls,xlsx,ppt,pptx,mp4', 'max:51200'],
        ];
    }

    public function messages(): array
    {
        return [
            'description.min'  => 'The project description must be at least 20 characters.',
            'documents.max'    => 'You may upload a maximum of 5 documents.',
            'documents.*.max'  => 'Each document must not exceed 50 MB.',
            'documents.*.mimes' => 'Allowed file types: PDF, DOC, DOCX, JPG, PNG, XLS, XLSX, PPT, PPTX, MP4.',
        ];
    }
}
