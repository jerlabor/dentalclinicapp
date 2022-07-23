<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePatientRequest extends FormRequest
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
            'biodata.first_name'        => 'required|string',
            'biodata.middle_name'       => 'required|string',
            'biodata.suffix'            => 'nullable|string',
            'biodata.last_name'         => 'required|string',
            'biodata.birth_date'        => 'required|date',
            'biodata.gender'            => 'required',
            'biodata.marital_status_id' => 'required',
            'biodata.occupation'        => 'required|string',
            'biodata.spouse'            => [
                Rule::requiredIf($this->input('biodata.marital_status_id') === 2),
                'nullable',
                'string'
            ],
            'biodata.telephone'         => 'nullable|string',
            'biodata.mobile_no'         => 'required|string',
            'biodata.address'           => 'required|string',
            'biodata.height'            => 'required|numeric',
            'biodata.weight'            => 'required|numeric',
            'biodata.remarks'           => 'required|string',

            'medicalHistory.is_care_of_physician'      => 'required|boolean',
            'medicalHistory.physician.physician_name'  => [
                Rule::requiredIf($this->input('medicalHistory.marital_status_id') === 1),
                'nullable',
                'string'
            ],
            'medicalHistory.physician.address'         => 'nullable|string',
            'medicalHistory.physician.months_attended' => 'nullable|numeric',
            'medicalHistory.physician.contact_no'      => 'nullable|string',

            'medicalHistory.hospitalized'              => 'required|boolean',
            'medicalHistory.hospitalized_reason'       => 'required_if:medicalHistory.hospitalized,1',
            'medicalHistory.is_taking_medication'      => 'required|boolean',
            'medicalHistory.medications'               => 'required_if:medicalHistory.is_taking_medication,1',
            'medicalHistory.allergic'                  => 'required|boolean',
            'medicalHistory.allergy_details'           => 'required_if:medicalHistory.allergic,1',
            'medicalHistory.smoke'                     => 'required|boolean',
            'medicalHistory.illnesses'                 => 'nullable|array',
//            'medicalHistory.illnesses.illness_details' => 'sometimes|required|string',
//            'medicalHistory.illnesses.id' => 'sometimes|required|numeric',

            'dentalHistory.dental_problem'           => 'nullable|string',
            'dentalHistory.last_dental_visit'        => 'nullable|date',
            'dentalHistory.previous_dentist'         => 'nullable|string',
            'dentalHistory.address_previous_dentist' => 'nullable|string',
            'dentalHistory.teeth_illnesses'          => 'nullable|array',
            'dentalHistory.teeth_illnesses.details'  => 'nullable|string',

        ];
    }
}
