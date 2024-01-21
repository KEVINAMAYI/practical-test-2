<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContractRequest extends FormRequest
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
            'contract_number' => 'required|integer',
            'travel_agent_id' => 'required|exists:travel_agents,id',
            'exclusive' => 'required|string',
            'start_date' => 'required|string',
            'description' => 'required',
            'standard_rate' => 'required|string',
        ];
    }
}
