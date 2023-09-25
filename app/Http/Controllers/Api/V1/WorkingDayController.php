<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkingDayRequest;
use App\Http\Requests\UpdateWorkingDayRequest;
use App\Models\WorkingDay;

class WorkingDayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkingDayRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WorkingDay $workingDay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkingDayRequest $request, WorkingDay $workingDay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkingDay $workingDay)
    {
        //
    }
}
