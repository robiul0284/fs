<?php

namespace App\Http\Controllers\Admin;

use App\BankDetails;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'keep moving';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank.bankDtails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bankDtails = new BankDetails();
        $bankDtails->bank_name = $request->b_name;
        $bankDtails->account_name = $request->a_name;
        $bankDtails->account_number = $request->number;
        $bankDtails->branch = $request->branch;
        $bankDtails->address = $request->address;
        $bankDtails->phone = $request->phone;
        $bankDtails->save();

        return redirect()->route('bank.index')->with('successMsg', 'Successfully bank added');
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
