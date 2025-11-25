<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePortfolioRequest extends FormRequest
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
            'project_name' => 'required|string|max:255|unique:portofolio,project_name',
            'status' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'owner_project' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nilai_kontrak' => 'required|string',
            'jenis_bangunan' => 'required|string|max:255',
            'waktu' => 'required|date',
            'status_update' => 'required|string|max:255',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'project_name.required' => 'Project name is required',
            'project_name.unique' => 'This project name is already in use',
            'project_name.max' => 'Project name cannot exceed 255 characters',
            'status.required' => 'Status is required',
            'location.required' => 'Location is required',
            'owner_project.required' => 'Project owner is required',
            'alamat.required' => 'Address is required',
            'nilai_kontrak.required' => 'Contract value is required',
            'jenis_bangunan.required' => 'Building type is required',
            'waktu.required' => 'Time is required',
            'waktu.date' => 'Time must be a valid date',
            'status_update.required' => 'Status update is required',
            'images.required' => 'At least one image is required',
            'images.*.image' => 'File must be an image',
            'images.*.mimes' => 'Image must be jpeg, png, or jpg',
            'images.*.max' => 'Image size cannot exceed 2MB',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'project_name' => 'project name',
            'owner_project' => 'project owner',
            'nilai_kontrak' => 'contract value',
            'jenis_bangunan' => 'building type',
            'status_update' => 'status update',
        ];
    }
}

