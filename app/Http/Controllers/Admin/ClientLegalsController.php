<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Client\StoreLegalDetailRequest;
use App\Http\Requests\Admin\Client\UpdateLegalDetailRequest;
use App\Models\Client\LegalDetail;

class ClientLegalsController extends Controller
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
    public function store(StoreLegalDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalDetail $legalDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalDetail $legalDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLegalDetailRequest $request, LegalDetail $legalDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalDetail $legalDetail)
    {
        //
    }
}
