<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Monarobase\CountryList\CountryListFacade;
use Validator;
use Carbon\Carbon;
use Hash;
use Auth;
use Mail;
use App\Mail\PasswordResetSend;
use Session;
use App\Models\User;
use App\Models\Contact;
use App\Models\PasswordReset;
use App\Events\welcomeEmail;
use Illuminate\Support\Str;
use DB;

class AuthenticationController extends Controller
{
    public function register(){
        $allcountries =CountryListFacade::getList("en");
        return view("users.Auth.register",compact("allcountries"));
    }

    public function store_user(Request $request){
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
            // dd($validated);
        }
        $requestData = $request->all();

        $filename = '';
        $filename = uploadImage("profile",$request->image);

        $requestData["image"] = $filename;
        $requestData["age"] = Carbon::parse($requestData["age"])->age;

        $requestData["password"] = Hash::make($requestData["password"]);
        $user = User::create($requestData);
        // event(new welcomeEmail($user));
        return redirect(route("login"));
    }
    public function login(){
        return view("users.Auth.login");
    }

    public function auth_user(Request $request){
        $validated = Validator::make($request->all(),[
            "email" => "required",
            "password" => "required",
        ]);

        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }
        $requestData = $request->only("email","password");
        if(Auth::attempt($requestData)){
             if(Auth::user()->role == 1){
                return redirect(route("AdminHome"));
             }else{
                 return redirect(route("home"));
             }
        }else{
            return redirect(route("login"))->withError("please try again there is error");
        }
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route("login"));
    }

    public function profile(){

        $user = Auth::user();
        $allcountries =CountryListFacade::getList("en");
        return view("users.Auth.profile",compact("user","allcountries"));
    }
    public function update_profile(Request $request){
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
            // dd($validated);
        }
        $requestData = $request->except("_token","_method");
        $user = User::find(Auth::id());
        $user->update($requestData);
        return redirect(route("updateProfile"))->withsuccess("the profile updated succefully");
    }
    public function update_image(Request $request){
        if($request->hasFile('image')){


            $filename = '';
            $filename = uploadImage("profile",$request->image);
            $requestData = $request->all();
            $requestData["image"] = $filename;
            $user = User::find(Auth::id());
            $user->update($requestData);
            return redirect(route("updateProfile"))->withsuccess("the image updated succefully");
        }
        return redirect(route("updateProfile"))->witherrorimage("You should choose image ");
    }
    public function Contact_us(){
        return view("users.Auth.Contact");
    }
    public function Contact_store(Request $request){
        $validated = Validator::make($request->all(),[
            "name" => "required|max:20|min:5",
            "email" => "required|email",
            "subject" => "required",
            "message" => "required"
        ]);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }
        $requestData = $request->all();

        Contact::create($requestData);
        return redirect()->back()->with(['success' => 'Thank you for contact us. we will contact you shortly.']);
    }
    public function forget_password(){
        return view("users.Auth.forgetPassword");
    }
    public function send_forget_password_email(Request $request){
        $validated = Validator::make($request->all(),[
            "email" => "required|email|exists:users,email",
        ]);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }
        $requestData = $request->except('_token');
        $requestData['token'] = Str::random(40);

        $passordreset = DB::table('password_resets')->insert($requestData);

        Mail::to($requestData['email'])->send(new PasswordResetSend($requestData));

        return redirect()->back()->with(['success' => 'the link is sended to your email , please check your email.']);
    }

    public function reset_password(Request $request, $token){
        $checkData = DB::table('password_resets')->where('email',$request->email)->where('token',$token)->count();
        $email = $request->email;
            if($checkData > 0 ){
                return view("users.Auth.confirmpassword",compact('email'));
            }else{
                return redirect()->route('ForgetPassword')->with(['error' => "sorry :( , this user is not found try again "]);
            }
    }

    public function confirm_password(Request $request){
        $validated = Validator::make($request->all(),[
            "password" => "required|max:20|min:8",
            "password_confirm" => "required|same:password|min:8",
        ]);
        if($validated->fails()){
            return redirect()->back()->withErrors($validated)->withInput($request->all());
        }
        $user = User::where('email',$request->email)->update(["password" => bcrypt($request->password)]);
        return redirect(route("login"));
    }
}
