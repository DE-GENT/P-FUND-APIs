<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitDeliverableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file'        => ['required', 'file', 'mimes:pdf,doc,docx,jpg,jpeg,png,zip,rar,xls,xlsx,ppt,pptx', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.max'   => 'The deliverable file must not exceed 10 MB.',
            'file.mimes' => 'Allowed file types: PDF, DOC, DOCX, JPG, PNG, ZIP, RAR, XLS, XLSX, PPT, PPTX.',
        ];
    }
}
