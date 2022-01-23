<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\PurchaseTransaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseTransactionController extends Controller
{
    public function editorPurchaseTransaction(Request $request)
    {
        $purchaseTransaction = PurchaseTransaction::find($request->purchaseTransactionId);
        $customers = Customer::all();
        $products = Product::all();
        return view('ms_purchase_transaction.editor', compact('purchaseTransaction', 'customers', 'products'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $purchaseTransaction = PurchaseTransaction::orderBy('id', 'DESC')->get();
            return DataTables::of($purchaseTransaction)
            ->addIndexColumn()
            ->editColumn('customer', function($purchaseTransaction) {
                return $purchaseTransaction->customer->name;
            })
            ->editColumn('product', function($purchaseTransaction) {
                return $purchaseTransaction->product->name;
            })
            ->addColumn('action', function($purchaseTransaction) {
                $action = '<div class="btn-group" role="group"> <button class="btn btn-primary btn-sm" data-id="'.$purchaseTransaction['id'].'" id="edit"> <i class="fas fa-edit"></i> </button> ';
                $action .= '<button class="btn btn-danger btn-sm" data-id="'.$purchaseTransaction['id'].'" id="delete" title="Delete"> <i class="fa fa-trash"></i> </button> </div>';
                return $action;
            })
            ->rawColumns(['DT_RowIndex', 'customer', 'product', 'action'])
            ->make(true);
        }
        return view('ms_purchase_transaction.index');
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
