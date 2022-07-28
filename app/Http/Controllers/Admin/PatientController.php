<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Illness;
use App\Models\MaritalStatus;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Resources\PatientCollection;
use App\Http\Requests\Admin\StorePatientRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        return inertia('Admin/Patient/PatientIndex',['patients' => new PatientCollection(Patient::all())]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $maritalStatuses = MaritalStatus::all();
        $medicalIllnesses = Illness::whereIllnessGroup(1)->get();
        $dentalIllnesses = Illness::whereIllnessGroup(2)->get();
        return inertia('Admin/Patient/PatientCreate',compact('maritalStatuses','medicalIllnesses','dentalIllnesses'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function store(StorePatientRequest $request)
    {
        DB::transaction(function() use($request){
                $patient = auth()->user()->patients()->create($request->validated()['biodata']);
                $medicalHistory = $patient->medicalHistory()->create($request->validated()['medicalHistory']);

                //if has physician
                if($request->input('medicalHistory.is_care_of_physician')) {
                    $medicalHistory->physician()->create($request->validated()['medicalHistory']['physician']);
                }

                $patient->dentalHistory()->create($request->validated()['dentalHistory']);

            $illnesses = array_merge($request->input('medicalHistory.illnesses'),$request->input('dentalHistory.illnesses'));
            $patient->illnesses()->sync($illnesses);

                return $patient;
            });
        return Redirect::route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Patient $patient
     * @return Response
     */
    public function show(Patient $patient)
    {
        $medicalIllnesses = Illness::whereIllnessGroup(1)->get();
        $dentalIllnesses = Illness::whereIllnessGroup(2)->get();
        $maritalStatuses = MaritalStatus::all();
        $patient->load('medicalHistory.physician','illnesses','dentalHistory','treatmentPlans','maritalStatus','media');
        return inertia('Admin/Patient/PatientShow',compact('medicalIllnesses','dentalIllnesses','patient','maritalStatuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Patient $patient
     * @return Response
     */
    public function edit(Patient $patient)
    {
        $patient->load('medicalHistory.physician','dentalHistory','illnesses');
        $maritalStatuses = MaritalStatus::all();
        $medicalIllnesses = Illness::whereIllnessGroup(1)->get();
        $dentalIllnesses = Illness::whereIllnessGroup(2)->get();
        return inertia('Admin/Patient/PatientEdit',compact('maritalStatuses','medicalIllnesses','dentalIllnesses','patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Patient $patient
     * @return Response
     */
    public function update(StorePatientRequest $request, Patient $patient)
    {

         DB::transaction(function() use($request,$patient){
            $patient->load('medicalHistory.physician', 'dentalHistory');
            $bioData = $request->validated()['biodata'];
            $medicalHistoryData = Arr::except($request->validated()['medicalHistory'], ['patient_illnesses', 'physician']);
            $dentalHistoryData = Arr::except($request->validated()['dentalHistory'], 'teeth_illnesses');

            $patient->update($bioData);
            $medicalHistory = $patient->medicalHistory;

            $medicalHistory->update($medicalHistoryData);

            //if has physician
            if ($request->input('medicalHistory.is_care_of_physician')) {
                $medicalHistory->physician()->updateOrCreate($request->input('medicalHistory.physician'));
            }else{
                $medicalHistory->physician()->delete();
            }

            $patient->dentalHistory->update($dentalHistoryData);
             $illnesses = array_merge($request->input('medicalHistory.illnesses'),$request->input('dentalHistory.illnesses'));
             $patient->illnesses()->sync($illnesses);
            return $patient;
        });


        return Redirect::route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Patient $patient
     * @return Response
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();

        return back();
    }
}
