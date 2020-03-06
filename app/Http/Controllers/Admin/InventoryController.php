<?php

namespace App\Http\Controllers\Admin;

use App\Godown;
use App\Http\Controllers\Controller;
use App\Inventory;
use App\Product;
use App\StockMove;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventories = DB::table('inventories')
            ->join('products', 'products.id', '=', 'inventories.product_id')
            ->select(DB::raw('inventories.product_id as product_id, products.name as product_name, sum(CASE WHEN inventories.godowns_id=1 THEN quantity ELSE 0 END) AS show_room,
                sum(CASE WHEN inventories.godowns_id=2 THEN quantity ELSE 0 END) as godown_1, sum(CASE WHEN inventories.godowns_id=3 THEN quantity ELSE 0 END) as godown_2, sum(quantity) as stock'))
            ->groupBy('products.name')
            ->orderBy('products.name', 'asc')
            ->get();


        return view('admin.inventory.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Product::all();
        $godowns = Godown::all();

        return view('admin.inventory.move', compact('items', 'godowns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->productId as $productKey => $valueOfProductId)
        {
            $i = $productKey;
            $inventory = Inventory::where('product_id', $request->productId[$i])->where('godowns_id', $request->fromGodownId[$i])->first();
            if (!empty($inventory))
            {
                $updateQuantity = $inventory->quantity - $request->quantity[$i];
                DB::table('inventories')
                    ->where('product_id', '=', $request->productId[$i])
                    ->where('godowns_id', '=', $request->fromGodownId[$i])
                    ->update(['quantity'=> $updateQuantity, 'updated_at' => \Carbon\Carbon::now()]);
                $inventoryUpdated = Inventory::where('product_id', $request->productId[$i])->where('godowns_id', '=', $request->toGodownId[$i])->first();
                if (!empty($inventoryUpdated))
                {
                    $inventoryUpdatedQuantity = $inventoryUpdated->quantity + $request->quantity[$i];
                    DB::table('inventories')
                        ->where('product_id', '=', $request->productId[$i])
                        ->where('godowns_id', '=', $request->toGodownId[$i])
                        ->update(['quantity'=> $inventoryUpdatedQuantity ]);
                    $moveData = array(
                        'product_id' => $request->productId[$i],
                        'quantity' => $request->quantity[$i],
                        'from_godowns' => $request->fromGodownId[$i],
                        'to_godowns' => $request->toGodownId[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );
                    StockMove::insert($moveData);
                }else{
                    $inventoryData = array(
                        'product_id' => $request->productId[$i],
                        'quantity' => $request->quantity[$i],
                        'godowns_id' => $request->toGodownId[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );
                    Inventory::insert($inventoryData);

                    $moveData = array(
                        'product_id' => $request->productId[$i],
                        'quantity' => $request->quantity[$i],
                        'from_godowns' => $request->fromGodownId[$i],
                        'to_godowns' => $request->toGodownId[$i],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    );
                    StockMove::insert($moveData);
                }
            }
        }
        return redirect()->route('inventory.index')->with('successMsg', 'Stock movement Successfully');
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
