<?php

namespace MuhammadAbdElHay\DataMigration\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMigrationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'table_from' => ['required', 'string'],
            'to_type' => ['required', 'string', 'in:table,api'],

            'table_to' => ['string', 'required_if:to_type,table'],
            'columns_from' => ['nullable', 'array'],
            'columns_to' => ['nullable', 'array'],

            'api_url' => ['string', 'required_if:to_type,api'],
            'api_method' => ['nullable', 'string'],
            'api_access_token' => ['nullable', 'string'],
            'api_payload' => ['nullable', 'array'],
        ];
    }
}
