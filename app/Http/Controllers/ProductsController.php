<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreProductsRequest;
use App\Http\Requests\UpdateProductsRequest;
use App\Models\Products;

class ProductsController extends Controller
{
    /*------------------
    //管理画面
    -------------------*/

    public function index() //一覧用
    {
        $product_index = Products::orderBy('sort', 'asc')->get();
        return $product_index;
    }

    public function show(Products $product) //個別ページ用
    {
        return $product;
    }

    public function store(StoreProductsRequest $request) //新規ページ用
    {

            if ($request->file('file_name')) {
                $file_name = $request->file('file_name')->getClientOriginalName();
                $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
            } else {
                $file_name = "";
                $file_path = "";
            };

        $input_products = new Products();
        $input_products->title = $request['title'];
        $input_products->url = $request['url'];
        $input_products->file_path = $file_path;
        $input_products->file_name = $file_name;

        $input_products->save();
    }

    public function update(UpdateProductsRequest $request, Products $product) //更新用
    {
        //var_dump($request['content']);

        $update_products = $product::find($product["id"]);

        if ($request->file('file_name')) {
            $file_name = $request->file('file_name')->getClientOriginalName();
            $file_path = $request->file('file_name')->storeAs('img', $file_name, 'public');
        } else {
            $file_name = "";
            $file_path = "";
        }

        $update_products->title = is_null($request['title']) ? "" : $request['title'];
        $update_products->url = is_null($request['url']) ? "" : $request['url'];
        $update_products->file_path = $file_path;
        $update_products->file_name = $file_name;

        $update_products->update();
    }

    public function destroy(Products $product) //削除用
    {
        var_dump($product);
        $product->delete();
        return $product; //削除したデータを返す。
    }


    public function save(Request $request) //全順番更新用
    {

        $products = Products::all();

        foreach ($products as $product) {
            $product->timestamps = false;
            $id = $product->id;
            foreach ($request->products as $productFrontEnd) {
                if ($productFrontEnd['id'] == $id) {
                    $product->update(['sort' => $productFrontEnd['order']]);
                }
            }
        }
        return;
    }

    /*------------------
    //サイト
    -------------------*/
    public function showsite(Products $product) //サイト用
    {
        $products = Products::all();
        return view('site', compact('products'));
    }
}
