<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Illness;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PatientMedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Patient $patient)
    {
        $patient->load('medicalHistory.physician','illnesses.illness');
        $illnesses = Illness::whereIllnessGroup(1)->get();
        return inertia('Admin/Patient/Form/MedicalHistory',array('illnesses' => $illnesses, 'step' => 2,'patient' => $patient));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Patient $patient)
    {

        $validated = $request->validate(
            [
            'is_care_of_physician'      => 'required|boolean',
            'physician.physician_name'  => 'nullable|string',
            'physician.address'         => 'nullable|string',
            'physician.months_attended' => 'nullable|numeric',
            'physician.contact_no'      => 'nullable|string',

            'hospitalized'              => 'required|boolean',
            'hospitalized_reason'       => 'required_if:hospitalized,1',
            'is_taking_medication'      => 'required|boolean',
            'medications'               => 'required_if:is_taking_medication,1',
            'allergic'                  => 'required|boolean',
            'allergy_details'           => 'required_if:allergic,1',
            'smoke'                     => 'required|boolean',
            'patient_illnesses'         => 'nullable|array',
            'patient_illnesses.details' => 'nullable|string'
            ]
        );

             $medicalHistory = $patient->medicalHistory()->updateOrCreate(['patient_id' => $patient->id],$validated);

            //if has physician
            if($request->input('is_care_of_physician') === 1) {
                $medicalHistory->physician()->create($validated['physician']);
            }

            return Redirect::route('patients.dental-history.create',$patient->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
