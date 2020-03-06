<?php

namespace App\Http\Controllers\Admin;

use App\AccountReceivable;
use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receivables = DB::table('account_receivables')
            ->join('customers', 'customers.id', 'account_receivables.customer_id')
            ->select(DB::raw('account_receivables.customer_id as id, customers.name as name, customers.address as address, sum(amount) as amount'))
            ->orderBy('account_receivables.customer_id', 'desc')
            ->groupBy('account_receivables.customer_id')
            ->get();
        $totalReceivable = AccountReceivable::sum('amount');

        return view('admin.receivable.index', compact('receivables', 'totalReceivable'));
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
    public function store(Request $request)
    {
        //
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
        $customer = Customer::find($id);
        $balance = DB::table('account_receivables')
            ->join('customers', 'customers.id', 'account_receivables.customer_id')
            ->select(DB::raw( 'sum(amount) as amount'))
            ->where('customer_id', $id)
            ->first();

        return view('admin.receivable.receivable', compact('customer', 'balance'));
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
