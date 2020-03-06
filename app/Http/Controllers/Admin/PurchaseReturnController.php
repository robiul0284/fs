<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PurchaseItem;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
    public function index()
    {
        return view('admin.purchase.return');
    }

    public function return(Request $request)
    {
        $invoiceNumber = $request->purchaseNumber;
        $purchaseReturns = PurchaseItem::where('purchase_id', '=', $request->purchaseNumber)
            ->join('products', 'products.id', 'purchase_items.product_id')
            ->select('products.id as id', 'products.name as productName', 'purchase_items.quntity as quantity', 'purchase_items.unit_price as price')
            ->get();

       return view('admin.purchase.edit', compact('purchaseReturns', 'invoiceNumber'));
    }

    public function save(Request $request)
    {
        foreach ($request->productId as $key => $valueOfProduct){
            $invoiceNumber = PurchaseItem::where('purchase_id', $request->invoiceNumber);
            if (!empty($invoiceNumber)){

            }
        }


    }
}
