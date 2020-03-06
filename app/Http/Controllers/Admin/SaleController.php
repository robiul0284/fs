<?php

namespace App\Http\Controllers\Admin;

use App\AccountReceivable;
use App\Cash;
use App\CashReceipt;
use App\Customer;
use App\Godown;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\PaymentType;
use App\Product;
use App\Sale;
use App\SalesItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();
        $items = Product::all();
        $godowns = Godown::all();
        $types = PaymentType::all();
        return view('admin.sale.index', compact('customers', 'items', 'godowns', 'types'));
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
        $this->validate($request, [
            'customerId' => 'required',
            'paymentTypeId' => 'required',
            'productId' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'godownId' => 'required'
        ]);

        $sales = new Sale();
        $sales->customer_id = $request->customerId;
        $sales->amount = $request->total;
        $sales->payment_type_id = $request->paymentTypeId;
        $sales->save();
        $lastId = $sales->id;

        //inserted sales item and reduce inventory quantity
        if ($lastId != 0)
        {
            foreach ($request->productId as $productkey => $valueOfProductId)
            {
                $i = $productkey;
                $data = array(
                    'sales_id' => $lastId,
                    'product_id' => $valueOfProductId,
                    'quantity' => $request->quantity[$i],
                    'sales_price' => $request->price[$i],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                );
                SalesItem::insert($data);

                $inventory = Inventory::where('product_id', $valueOfProductId)->where('godowns_id', $request->godownId[$i])->first();
                if (!empty($inventory))
                {
                    $updateQuantity = $inventory->quantity - $request->quantity[$i];
                    DB::table('inventories')
                        ->where('product_id', '=', $valueOfProductId)
                        ->where('godowns_id', '=', $request->godownId[$i])
                        ->update(['quantity'=>$updateQuantity, 'updated_at'=>\Carbon\Carbon::now()]);
                }
            }

            // insert transaction amount in cash or account receivable
            if ($request->paymentTypeId==1)
            {
                $cashReceived = new CashReceipt();
                $cashReceived->customer_id = $request->customerId;
                $cashReceived->receipt = $request->total;
                $cashReceived->save();

                $cashBalance = DB::table('cashes')
                    ->select('balance')
                    ->orderBy('id', 'desc')
                    ->first();
                $balance = $cashBalance->balance + $request->total;

                $cash = new Cash();
                $cash->transaction_id = 1;
                $cash->amount = $request->total;
                $cash->balance = $balance;
                $cash->save();
            }
            elseif ($request->paymentTypeId == 2)
            {
                $accountReceiveable = new AccountReceivable();
                $accountReceiveable->customer_id = $request->customerId;
                $accountReceiveable->amount = $request->total;
                $accountReceiveable->save();
            }
        }

        return redirect()->route('sale.index')->with('successMsg', 'Memo successfully entry');
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
