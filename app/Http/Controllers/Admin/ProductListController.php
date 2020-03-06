<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductListController extends Controller
{
    public function productList(Request $request)
    {
        $data = [];
        if ($request->has('q'))
        {
            //return $request->has('q');
            $search = $request->has('q');
            $data = DB::table('products')
                ->select('id', 'name')
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }

        return response()->json($data);

    }

    public function ajaxQuantity($id)
    {
        $data = DB::table('inventories')
            ->select(DB::raw('sum(quntity) as quntity'))
            ->where('product_id', $id)
            ->groupBy('product_id')
            ->get();

        return json_encode($data);

    }
}
