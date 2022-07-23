<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Illness;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PatientDentalHistoryController extends Controller
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
        $patient->load(['dentalHistory','illnesses.illness']);
        $illnesses = Illness::whereIllnessGroup(2)->get();
        return inertia('Admin/Patient/Form/DentalHistory',array('illnesses' => $illnesses, 'step' => 3,'patient' => $patient));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Patient $patient)
    {
        $validated = $request->validate([
            'dental_problem'           => 'nullable|string',
            'last_dental_visit'        => 'nullable|date',
            'previous_dentist'         => 'nullable|string',
            'address_previous_dentist' => 'nullable|string',
            'teeth_illnesses'          => 'nullable|array',
            'teeth_illnesses.details'  => 'nullable|string',
        ]);
        $patient->dentalHistory()->create($validated);

        return Redirect::route('patients.index');
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
