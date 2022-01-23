<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function editorCustomer(Request $request)
    {
        $customer = Customer::find($request->customerId);
        return view('ms_customers.editor', compact('customer'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $customer = Customer::orderBy('id', 'DESC')->get();
            return DataTables::of($customer)
                ->addIndexColumn()
                ->addColumn('action', function ($customer) {
                    $action = '<div class="btn-group" role="group"> <button class="btn btn-primary btn-sm" data-id="'.$customer['id'].'" id="edit"> <i class="fas fa-edit"></i> </button> ';
                    $action .= '<button class="btn btn-danger btn-sm" data-id="'.$customer['id'].'" id="delete" title="Delete"> <i class="fa fa-trash"></i> </button> </div>';
                    return $action;
                })
                ->rawColumns(['DT_RowIndex', 'action'])
                ->make(true);
        }
        return view('ms_customers.index');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Customer::create([
                'name' => $request->name,
                'address' => $request->address
            ]);
            return response()->json(['code' => 1, 'msg' => 'Success Create Data']);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Customer::where('id', $id)->update([
                'name' => $request->name,
                'address' => $request->address
            ]);
            return response()->json(['code' => 1, 'msg' => 'Data success update']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::where('id', $id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Data success deleted']);
    }
}
