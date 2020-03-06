<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\BankDetails;
use App\Http\Controllers\Controller;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = DB::table('banks')
            ->join('bank_details', 'bank_details.id', 'banks.bank_id')
            ->select(DB::raw('banks.bank_id as id, bank_details.account_name as account_name, bank_details.bank_name as bank_name, bank_details.branch as branch, sum(amount) as amount'))
            ->orderBy('banks.bank_id', 'desc')
            ->groupBy('banks.bank_id')
            ->get();

        $totalAmount = Bank::sum('amount');

        return view('admin.bank.index', compact('banks', 'totalAmount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = BankDetails::all();
        $transactionTypes = TransactionType::all();
        return view('admin.bank.create', compact('banks', 'transactionTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->transactionType==1 || $request->transactionType==7)
        {
            $bank = new Bank();
            $bank->bank_id = $request->bankId;
            $bank->amount = $request->amount;
            $bank->save();
        }elseif ($request->transactionType==8){
            $bank = new Bank();
            $bank->bank_id = $request->bankId;
            $bank->amount = -$request->amount;
            $bank->save();
        }else{
            return redirect()->route('bank.create')->with('successMsgDe', 'Please select your tanscation type as Initial balance, deposit, withdraw, expanse, Income');
        }
        return redirect()->route('bank.index');
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
