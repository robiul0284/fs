<?php

namespace App\Http\Controllers\Admin;

use App\Cash;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Translation\Interval;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $today = date('Y-m-d');
        $todayDate = date('Y-m-d');
        $cashes = DB::table('cashes')
            ->join('transaction_types', 'transaction_types.id', '=', 'cashes.transaction_id')
            ->select(DB::raw('cashes.updated_at as TransactionDate, CASE WHEN cashes.transaction_id=2 THEN amount ELSE 0 END as ReceivedCash,
            CASE WHEN cashes.transaction_id=3 THEN amount ELSE 0 END as PaymentCash, balance as RemainingBalance'))
            ->orderBy('cashes.id', 'desc')
            ->whereDate('cashes.created_at', $today)
            ->get();

        $cashBalance = DB::table('cashes')
            ->select('balance')
            ->whereDate('created_at', date('Y-m-d', strtotime('-1 day')))
            ->orderBy('created_at', 'desc')
            ->first();

        return view('admin.cash.index', compact('cashes', 'cashBalance'));
    }

    /**
     * Show the form for creating a new resource.
     *https://stackoverflow.com/questions/16009152/how-to-get-date-of-yesterday-using-php
     * https://stackoverflow.com/questions/46793741/laravel-eloquent-where-created-at-is-x-days-ago
     * https://stackoverflow.com/questions/49342407/laravel-show-users-from-the-last-30-days
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
