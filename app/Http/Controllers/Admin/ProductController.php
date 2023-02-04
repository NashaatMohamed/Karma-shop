<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use App\Models\SubCategories;
use App\Models\Brand;
use Validator;
use DB;

class ProductController extends Controller
{
    public function index(){
        $Categories = Categories::all();
        $brands = Brand::all();
        $sub_Categories = SubCategories::all();
        return view("Admin.MySite.Products.products_list",compact("Categories","brands","sub_Categories"));
    }

    public function Cat_SubCat(Request $request){
        $parent_id = $request->cat_id;

        $subcategories = Categories::where('id',$parent_id)
                              ->with('SubCategories')
                              ->get();
        return response()->json([
            'subcategories' => $subcategories
        ]);
    }
    public function create(){

        $allproducts = Products::all();
        $mybrand = DB::table('products as pro')->join("brands as brand","pro.brands_id","=","brand.id")
        ->select("brand.name as BrandName")->get();
        $mycategory = DB::table('products as pro')->join("categories as cat","pro.categories_id","=","cat.id")
        ->select("cat.name as CatName")->get();
        $mySubCat = DB::table('products as pro')->join("sub_categories as subCat","pro.sub_categories_id","=","subCat.id")
        ->select("subCat.name as subCatName")->get();
        if($allproducts)
        {
            return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $allproducts,
            ]);
        }


    }
    public function store(Request $request){
        $requestData = $request->all();
// return $requestData;
        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
            "description" => "required|max:255",
            "product-code" => "required|",
            "stock" => "required|numeric",
            "color" =>"required|regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i",
            "size" => "required",
            "price" =>"required|numeric",
            "sale_price" => "required|numeric",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "categories_id" => "required|numeric|exists:categories,id",
            "sub_categories_id" => "required|numeric|exists:sub_categories,id",
            "brands_id" => "required|numeric|exists:brands,id"
        ]);


        $filename = '';
        $filename = uploadImage("products",$request->image);
        $requestData['image'] = $filename;
        $products = Products::create($requestData);

        if($products) {
            return response()->json([
                'message' => "Data Inserted Successfully",
                "code"    => 200
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function edit(Request $request){
        $products = Products::where('id',$request->id)->first();
        // return $products;
        if($products)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $products
            ]);
        }
    }
    public function update(Request $request){


        $products = Products::where('id',$request->id)->first();
        // return $request->all();

        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
            "description" => "required|max:255",
            "product-code" => "required|",
            "stock" => "required|numeric",
            "color" =>"required|regex:/^#([a-f0-9]{6}|[a-f0-9]{3})$/i",
            "size" => "required",
            "price" =>"required|numeric",
            "sale_price" => "required|numeric",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            "categories_id" => "required|numeric|exists:categories,id",
            "sub_categories_id" => "required|numeric|exists:sub_categories,id",
            "brands_id" => "required|numeric|exists:brands,id"
        ]);

        if ($request->hasFile("image")){
            $filename = '';
            $filename = uploadImage("products",$request->image);
            $requestData = $request->all();
            $requestData['image'] = $filename;
            $products->fill($requestData)->save();
    }else{

        $products = Products::where('id',$request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "is_active" => $request->is_active,
            "color" =>$request->color,
            "stock" =>$request->stock,
            "size" =>$request->size,
            "price" =>$request->price,
            "sale_price" =>$request->sale_price,
            "productCode" =>$request->productCode,
            "categories_id" =>$request->categories_id,
            "sub_categories_id" =>$request->sub_categories_id,
            "brands_id" =>$request->brands_id,
        ]);
    }
        if($products) {
            return response()->json([
                'message' => "Data Updated Successfully!",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
    public function destroy(Request $request){
        $products = Products::where('id',$request->id)->delete();
        if($products) {
            return response()->json([
                'message' => "Data deleted Successfully!",
                "code"    => 200,
            ]);
        } else  {
            return response()->json([
                'message' => "Internal Server Error",
                "code"    => 500
            ]);
        }
    }
}
