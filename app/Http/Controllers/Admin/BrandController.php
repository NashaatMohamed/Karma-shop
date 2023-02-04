<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Validator;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Admin.MySite.Brands.brands_list");

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::get();

        if($brands)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $brands
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
            "description" => "required|different:fname|max:20|min:5",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);



        $filename = '';
        $filename = uploadImage("Brand",$request->image);
        $requestData['image'] = $filename;
        // return $requestData;
        $brand = Brand::create($requestData);
        if($brand) {
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
    public function edit(Request $request)
    {
        return request();
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
    public function editbrand(Request $request){
        $mybrand = Brand::where('id',$request->id)->first();
        if($mybrand)
        {
             return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => $mybrand
            ]);
        }
    }

    public function updatebrand(Request $request){

        $mybrand = Brand::where('id',$request->id)->first();
        if ($request->hasFile("image")){
            $filename = '';
            $filename = uploadImage("Brand",$request->image);
            $requestData = $request->all();
            $requestData['image'] = $filename;
            $mybrand->fill($requestData)->save();
    }else{

        $mybrand = Brand::where('id',$request->id)->update([
            "name" => $request->name,
            "description" => $request->description,
            "is_active" => $request->is_active
        ]);

    }
        if($mybrand) {
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
    public function deletebrand(Request $request){
        $brand = Brand::where("id",$request->id)->delete();
        if($brand) {
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
