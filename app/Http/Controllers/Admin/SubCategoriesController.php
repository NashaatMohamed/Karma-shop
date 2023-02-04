<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use DB;
use Validator;

class SubCategoriesController extends Controller
{
    public function index(){
        $Categories = Categories::all();
        return view("Admin.MySite.SubCategory.subcategories_list",compact("Categories"));
    }
    public function create(){
        // $subcategory = SubCategories::all();
        $subcategory = DB::table('sub_categories as SubCat')->join("categories as Cat","Cat.id","=","SubCat.categories_id")
        ->select("SubCat.name","SubCat.is_active","SubCat.id","Cat.name as CategoryName")->get();

        // return $subcategory;
        if($subcategory)
        {
            return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $subcategory
            ]);
        }
    }
    public function store(Request $request){
        $requestData = $request->all();
        // return $requestData;
        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
            "categories_id" => "required|numeric|exists:categories,id"
        ]);

        $SubCategory = SubCategories::create($requestData);
        if($SubCategory) {
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
        $SubCategory = SubCategories::where('id',$request->id)->first();
        // return $SubCategory;
        if($SubCategory)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $SubCategory
            ]);
        }
    }
    public function update(Request $request){
        $subcategory = SubCategories::where('id',$request->id)->first();

        $subcategory = SubCategories::where('id',$request->id)->update([
            "name" => $request->name,
            "categories_id" => $request->categories_id,
            "is_active" => $request->is_active
        ]);

        if($subcategory) {
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
        $subcategory = SubCategories::where('id',$request->id)->delete();
        if($subcategory) {
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
