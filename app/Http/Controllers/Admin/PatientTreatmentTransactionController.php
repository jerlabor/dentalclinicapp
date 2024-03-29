<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTreatmentTransaction;
use App\Http\Requests\StoreTreatmentTransactionRequest;
use App\Http\Requests\UpdateTreatmentTransactionRequest;
use App\Models\Patient;
use App\Models\TreatmentPlan;
use App\Models\TreatmentPlanTransaction;
use Illuminate\Http\Request;

class PatientTreatmentTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Patient $patient, TreatmentPlan $treatment)
    {
        $treatment->load('transactions');
        return inertia('Admin/Patient/TreatmentTransaction',compact('treatment','patient'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTreatmentTransactionRequest $request,Patient $patient, TreatmentPlan $treatment)
    {
        $treatment->transactions()->create($request->validated());

        return back();
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
    public function update(UpdateTreatmentTransactionRequest $request,Patient $patient, TreatmentPlan $treatment,TreatmentPlanTransaction $transaction)
    {
        $transaction->update($request->validated());

        return back();
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
