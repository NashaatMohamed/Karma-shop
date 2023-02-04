<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use Validator;
class CategoriesController extends Controller
{
    public function index(){
        return view("Admin.MySite.Categories.categories_list");
    }
    public function create(){
        $Categories = Categories::all();

        if($Categories)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $Categories
            ]);
        }
    }
    public function store(Request $request){
        $requestData = $request->all();
        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
        ]);

        // return $requestData;
        $category = Categories::create($requestData);
        if($category) {
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
        $Category = Categories::where('id',$request->id)->first();
        if($Category)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $Category
            ]);
        }
    }
    public function update(Request $request){
        $Category = Categories::where('id',$request->id)->first();

        $Category = Categories::where('id',$request->id)->update([
            "name" => $request->name,
            "is_active" => $request->is_active
        ]);

        if($Category) {
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
        $Category = Categories::where('id',$request->id)->delete();
        if($Category) {
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
