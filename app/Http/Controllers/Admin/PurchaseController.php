<?php

namespace App\Http\Controllers\Admin;

use App\AccountPayable;
use App\Cash;
use App\CashPayment;
use App\Godown;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Person;
use App\Product;
use App\Purchase;
use App\PurchaseItem;
use App\TransactionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::all();
        $items = Product::all();
        $godowns = Godown::all();
        $types = TransactionType::all();
        return view('admin.purchase.index', compact('people','items', 'godowns', 'types'));
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
            'supplierId' => 'required',
            'TransactionTypeId' => 'required',
            'productId' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'godownId' => 'required'
        ]);

        $purchase = new Purchase();
        $purchase->person_id = $request->supplierId;
        $purchase->amount = $request->total;
        $purchase->transaction_id = $request->TransactionTypeId;
        $purchase->save();
        $lastId = $purchase->id;


        // insert productItem
        if ($lastId !=0)
        {
            foreach ($request->productId as $key => $value)
            {
                $i = $key;
                $data=array(
                    'purchase_id'=>$lastId,
                    'product_id'=>$value,
                    'quantity'=>$request->quantity[$key],
                    'cost_price'=>$request->price[$key],
                    'unit_price'=>$request->price[$key],
                    'created_at'=> \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()

                );
                PurchaseItem::insert($data);

                $inventory = Inventory::where('product_id', $value)->where('godowns_id', $request->godownId[$i])->first();

                if(!empty($inventory)){
                    $updateQuantity = $inventory->quantity + $request->quantity[$i];
                    DB::table('inventories')
                        ->where('product_id', '=', $request->productId[$i])
                        ->where('godowns_id', '=', $request->godownId[$i])
                        ->update(['quantity' => $updateQuantity, 'updated_at' => \Carbon\Carbon::now() ]);
                }else{
                    $inventoryData = array(
                        'product_id' => $request->productId[$i],
                        'quantity' => $request->quantity[$i],
                        'godowns_id' => $request->godownId[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );
                    Inventory::insert($inventoryData);
                }
            }

            if ($request->TransactionTypeId==4)
            {
                $cashPayment = new CashPayment();
                $cashPayment->person_id = $request->supplierId;
                $cashPayment->payment = $request->total;
                $cashPayment->save();

                $cashBalance = DB::table('cashes')
                    ->select('balance')
                    ->orderBy('id', 'desc')
                    ->first();
                $balance = $cashBalance->balance - $request->total;
                $cash = new Cash();
                $cash->transaction_id = $request->TransactionTypeId;
                $cash->amount = $request->total;
                $cash->balance = $balance;
                $cash->save();

            }elseif ($request->TransactionTypeId==5)
            {
                $accountPayable = new AccountPayable();
                $accountPayable->person_id = $request->supplierId;
                $accountPayable->amount = $request->total;
                $accountPayable->save();
            }
        }

        return redirect()->route('purchase.index')->with('successMsg', 'Memo successfully entry');

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
