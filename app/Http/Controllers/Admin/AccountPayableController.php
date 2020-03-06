<?php

namespace App\Http\Controllers\Admin;

use App\AccountPayable;
use App\Cash;
use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountPayableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payables = DB::table('account_payables')
            ->join('people', 'people.id', '=', 'person_id')
            ->select(DB::raw('people.id as id, people.name as supplier_name, people.address as supplier_address, sum(amount) as amount'))
            ->groupBy('account_payables.person_id')
            ->orderBy('account_payables.person_id', 'desc')
            ->get();

        $totalPayable = AccountPayable::sum('amount');

        return view('admin.payable.index', compact('payables', 'totalPayable'));
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //return $id;
        $supplier = Supplier::find(3);

        $balance = DB::table('account_payables')
            ->join('people', 'people.id', '=', 'person_id')
            ->select(DB::raw('account_payables.person_id, people.name as supplier_name, people.address as supplier_address, sum(amount) as amount'))
            ->where('person_id', $id)
            ->first();

        return view('admin.payable.payment', compact('supplier','balance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * made payment transaction
     */
    public function update(Request $request, $id)
    {
        $payment = new AccountPayable();
        $payment->person_id = $id;
        $payment->amount = -$request->payment;
        $payment->save();

        $cashBalance = DB::table('cashes')
            ->select('balance')
            ->orderBy('id','desc')
            ->first();
        $balance = $cashBalance->balance - $request->payment;
        $cash = new Cash();
        $cash->transaction_id = 4;
        $cash->amount = $request->payment;
        $cash->balance = $balance;
        $cash->save();

        return redirect()->route('payable.index');
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
