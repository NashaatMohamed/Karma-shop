<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
use Validator;
use App\Models\Products;
use Carbon\Carbon;
use Hash;
use Monarobase\CountryList\CountryListFacade;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function index(){

        return view("Admin.Home");
    }

    public function test(){
        // return Auth::user()->fname;
        $allproducts = Products::all();
        return $allproducts;
        $mybrand = DB::table('products as pro')->join("brands as brand","pro.brands_id","=","brand.id")
        ->select("brand.name as BrandName")->get();
        // return $mybrand['BrandName'];
        // return $mybrand[0]->BrandName;
        return $allproducts[0]->push($mybrand[0]);
        $mycategory = DB::table('products as pro')->join("categories as cat","pro.categories_id","=","cat.id")
        ->select("cat.name as CatName")->get();
        $mySubCat = DB::table('products as pro')->join("sub_categories as subCat","pro.sub_categories_id","=","subCat.id")
        ->select("subCat.name as subCatName")->get();
        if($allproducts)
        {
            return response()->json([
                "message" => "data found",
                "code" => 200,
                "data" => [$allproducts,$mybrand,$mycategory,$mySubCat],
            ]);
        }
    }
    public function users_list(UsersDataTable $dataTable){
        $allcountries =CountryListFacade::getList("en");
        return $dataTable->render('Admin.Mysite.users.users_list',compact("allcountries"));
    }
    public function destroy_all(){
        if(is_array(request('item'))){
            User::destroy(request('item'));
        }else{
            User::find(request('item'))->delete();
        }
        return redirect(route("UserList"))->withsuccess("the items is deleted successfully");
    }

    public function destroy($id){
        User::find($id)->delete();

        return redirect(route("UserList"))->withsuccess("the item is deleted successfully");
    }

    public function edit_user($id){

        $user = User::find($id);
        $request = request();
        $validated = Validator::make($request->all(),[
            "fname" => "required|max:20|min:5",
            "lname" => "required|different:fname|max:20|min:5",
            "country" => "required",
            "phone" => "required|min:10",
            "email" => "required|email",
            "gender" => "required|in:Male,Female,other",
            "age" => "required",
        ]);


        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }

        if ($request->hasFile("image")){
            $filename = '';
            $filename = uploadImage("profile",$request->image);
            $requestData = $request->all();
            $requestData['image'] = $filename;
        $user->fill( $requestData)->save();
    }else{

        User::where('id', $id)->update(array('fname' => $request['fname'],
                                                 'lname'=> $request['lname'],
                                                 'age'=> $request['age'],
                                                 'country'=> $request['country'],
                                                 'phone'=> $request['phone'],
                                                 'email'=> $request['email'],
                                                 'gender'=> $request['gender'],
                                                ));
    }

    return redirect(route("UserList"))->withsuccess("the user is updated succefully");


    }
    public function create_user(){
        $allcountries =CountryListFacade::getList("en");
        return view("Admin.MySite.users.users_create",["allcountries" => $allcountries]);
    }
    public function Store_user(Request $request){
        $validated = Validator::make($request->all(),[
            "fname" => "required|max:20|min:5",
            "lname" => "required|different:fname|max:20|min:5",
            "country" => "required",
            "phone" => "required|min:10",
            "email" => "required|unique:users,email|email",
            "gender" => "required|in:Male,Female,other",
            "age" => "required",
            "password" => "required|min:8",
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }
        $requestData = $request->all();

        $filename = '';
        $filename = uploadImage("profile",$request->image);

        $requestData["image"] = $filename;
        $requestData["age"] = Carbon::parse($requestData["age"])->age;

        $requestData["password"] = Hash::make($requestData["password"]);
        $user = User::create($requestData);
        return redirect(route("UserList"))->withsuccess("the user is created succefully");
    }
    public function change_user_status(Request $request,$id,$status =1){

        $user = User::find($id);
        $user->is_active = $status ?? 1;
        $user->save();

        return Redirect()->back()->withsuccess("Status of user is updated successfully");
    }
}
