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
            'table_url' => ['string', 'required_if:to_type,api'],
            'columns_from' => ['nullable', 'array'],
            'columns_from.*' => ['string'],
            'columns_to' => ['array', 'nullable'],
            'columns_to.*' => ['string'],
        ];
    }
}
