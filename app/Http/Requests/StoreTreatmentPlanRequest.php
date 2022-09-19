<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentPlanRequest extends FormRequest
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
            'created_at' => 'sometimes|required|date',
            'treatment' => 'sometimes|required|string',
            'total_fee' => 'sometimes|required|numeric',
            'status_id' => 'sometimes|required|numeric',
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
            $total_fee = $this->input('total_fee');
            $total_paid = $this->route()->parameter('treatment')->total_paid;

            if(($total_fee - $total_paid) < 0) {
                $validator->errors()->add('total_fee', 'The total amount paid exceeds the new total fee.');
            }
        });
    }
}
