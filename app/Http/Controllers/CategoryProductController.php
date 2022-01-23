<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryProductController extends Controller
{
    public function editorCategoryProduct(Request $request)
    {
        $categoryProduct = CategoryProduct::find($request->categoryProductId);
        return view('ms_category_product.editor', compact('categoryProduct'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categoryProduct = CategoryProduct::orderBy('id', 'DESC')->get();
            return DataTables::of($categoryProduct)
                ->addIndexColumn()
                ->addColumn('action', function($categoryProduct) {
                    $action = '<div class="btn-group" role="group"> <button class="btn btn-primary btn-sm" data-id="'.$categoryProduct['id'].'" id="edit"> <i class="fas fa-edit"></i> </button> ';
                    $action .= '<button class="btn btn-danger btn-sm" data-id="'.$categoryProduct['id'].'" id="delete" title="Delete"> <i class="fa fa-trash"></i> </button> </div>';
                    return $action;
                })
                ->rawColumns(['DT_Row_Index', 'action'])
                ->make(true);
        }
        return view('ms_category_product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ms_category_product.editor');
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
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            CategoryProduct::create([
                'name' => $request->name,
                'code' => $request->code
            ]);
            return response()->json(['code' => 1, 'msg' => 'Data success create']);
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
            'code' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            CategoryProduct::where('id', $id)->update([
                'name' => $request->name,
                'code' => $request->code
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
        CategoryProduct::where('id', $id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Data success delete']);
    }
}
