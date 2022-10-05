<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'treatment_process'         => 'required|string',
            'details'                   => 'nullable|string',
            'fee'                       => 'required|numeric',
            'transaction_date'          => 'required|date'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $balance = $this->route()->parameter('treatment')->balance;
            $fee = $this->input('fee');

            if(($balance - $fee) < 0) {
                $validator->errors()->add('fee', 'Transactions amount must not exceed total fee.');
            }
        });
    }
}
