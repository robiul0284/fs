<?php

namespace App\Http\Controllers\Admin;

use App\Cash;
use App\Expanse;
use App\Http\Controllers\Controller;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ExpanseController extends Controller
{
    /**\
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = date('m');
        /*$expanses = DB::table('expanses')
            ->join('transaction_types', 'transaction_types.id', 'expanses.transaction_id')
            ->select(DB::raw('transaction_types.type as name, amount, updated_at as date'))
            ->whereMonth('created_at', $month)
            ->latest();*/
        /*$expanses = Expanse::join('transaction_types', 'transaction_types.id', 'expanses.transaction_id')
            ->select(DB::raw('transaction_types.type as name, expanses.description as description, expanses.amount as amount, expanses.created_at '))
            ->whereMonth('created_at', $month )
            ->get();*/
        $expanses = DB::table('expanses')
            ->join('transaction_types', 'transaction_types.id', 'expanses.transaction_id')
            ->select(DB::raw('transaction_types.type as name, expanses.description as description, expanses.amount as amount, expanses.created_at as date'))
            ->whereMonth('expanses.created_at', $month)
            ->orderBy('expanses.id', 'desc')
            ->get();

        return view('admin.expanse.index', compact('expanses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TransactionType::all();
        return view('admin.expanse.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->transactionType==9 || $request->transactionType==11)
        {
            $expanse = new Expanse();
            $expanse->transaction_id = $request->transactionType;
            $expanse->description = $request->description;
            $expanse->amount = $request->amount;
            $expanse->save();

            $cashBalance = DB::table('cashes')
                ->select('balance')
                ->orderBy('id', 'desc')
                ->first();

            $cash = new Cash();
            $cash->transaction_id = $request->transactionType;
            $cash->amount = $request->amount;
            $cash->balance = $cashBalance->balance - $request->amount;
            $cash->save();
        }else{
            return redirect()->route('expanse.create')->with('successMsgDe', 'Please select your transaction Type as expanse, personal');
        }

        return redirect()->route('expanse.index')->with('successMsg', 'Expanse successfully added');
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
