<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Person;
use App\PrettyCash;
use App\PrettyCashType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrettyCashController extends Controller
{
    public function index(){
        $prettyCashes = DB::table('pretty_cashes')
            ->join('people', 'people.id', '=', 'pretty_cashes.person_id' )
            ->join('pretty_cash_types', 'pretty_cash_types.id', '=', 'pretty_cashes.pct_id')
            ->select(DB::raw('people.id as personId, people.name as personName, sum(CASE WHEN pretty_cash_types.name in("lend") then amount ELSE 0 END) as lendAmount,
                sum(CASE WHEN pretty_cash_types.name in ("bring") THEN amount ELSE 0 END) as bringAmount'))
            ->groupBy('people.name')
            ->orderBy('people.name', 'asc')
            ->get();


        return view('admin.cash.pretty_index', compact('prettyCashes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $people = Person::all();
        $types = PrettyCashType::all();
        return view('admin.cash.pretty_transaction', compact('people', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function transaction(Request $request)
    {
        $this->validate($request,[
            'personId' => 'required',
            'typeId' => 'required',
            'amount' => 'required'
        ]);

        $prettyCash = new PrettyCash();
        $prettyCash->person_id = $request->personId;
        $prettyCash->pct_id = $request->typeId;
        $prettyCash->amount = $request->amount;
        $prettyCash->save();

        return redirect()->route('pretty.cash.index')->with('successMsg', 'Transaction Successfully completed');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $person = PrettyCash::where('person_id', '=', $id)
            ->join('people', 'people.id', 'pretty_cashes.person_id' )
            ->select(DB::raw('people.id as personId, people.name as personName, sum(amount) as amount'))
            ->groupBy('people.id')
            ->first();
        //dump($person);

        $prettyCashTypes = PrettyCashType::all();
        return view('admin.cash.receipt_payment', compact('person', 'prettyCashTypes'));
    }

    public function update(Request $request, $personId)
    {
        $this->validate($request,[
            'typeId' => 'required',
            'amount' => 'required'
        ]);

        $prettCash = new PrettyCash();
        $prettCash->person_id = $personId;
        $prettCash->pct_id = $request->typeId;
        $prettCash->amount = - $request->amount;
        $prettCash->save();

        return redirect()->route('pretty.cash.index')->with('successMsg', 'Transaction completed');


    }
}
