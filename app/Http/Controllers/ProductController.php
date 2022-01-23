<?php

namespace App\Http\Controllers;

use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function editorProduct(Request $request)
    {
        $product = Product::find($request->productId);
        $categoryProduct = CategoryProduct::all();
        return view('ms_product.editor',
            [
                'product' => $product,
                'categoryProduct' => $categoryProduct
            ]
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::orderBy('id', 'DESC')->get();
            return DataTables::of($product)
            ->addIndexColumn()
            ->editColumn('category_product', function($product) {
                return $product->category_product->name;
            })
            ->addColumn('action', function($product) {
                $action = '<div class="btn-group" role="group"> <button class="btn btn-primary btn-sm" data-id="'.$product['id'].'" id="edit"> <i class="fas fa-edit"></i> </button> ';
                $action .= '<button class="btn btn-danger btn-sm" data-id="'.$product['id'].'" id="delete" title="Delete"> <i class="fa fa-trash"></i> </button> </div>';
                return $action;
            })
            ->rawColumns(['DT_RowIndex', 'category_product', 'action'])
            ->make(true);
        }

        return view('ms_product.index');
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
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_product_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_product_id' => $request->category_product_id,
                'images' => $request->images
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
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'category_product_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            Product::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'category_product_id' => $request->category_product_id,
                'images' => $request->images
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
        Product::where('id', $id)->delete();
        return response()->json(['code' => 1, 'msg' => 'Data success deleted']);
    }
}
