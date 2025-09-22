<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserExtraitDecesRequest extends FormRequest
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
            'name' => 'required',
            'numberR' => 'required',
            'dateR' => 'required',
            'CNIdfnt' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
            'CNIdcl' => 'required|mimes:png,jpg,jpeg,pdf|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom du défunt est obligatoire.',
            'numberR.required' => 'Le numéro de l\'acte de décès est obligatoire.',
            'dateR.required' => 'La date de l\'acte de décès est obligatoire.',
            'CNIdfnt.required' => 'Le document CNIdfnt est obligatoire.',
            'CNIdcl.required' => 'Le document CNIdcl est obligatoire.',
            'documentMariage.required' => 'Le document du document de mariage est obligatoire.',
            'RequisPolice.required' => 'Le document requis de police est obligatoire.',
            'pActe.mimes' => 'Le document acte de décès doit être un format de fichier valide (png, jpg, jpeg, pdf).',
            'CNIdfnt.mimes' => 'Le document CNIdfnt doit être un format de fichier valide (png, jpg, jpeg, pdf).',
        ];
    }
}
