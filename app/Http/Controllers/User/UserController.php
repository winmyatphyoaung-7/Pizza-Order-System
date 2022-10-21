<?php

namespace App\Http\Controllers\User;
use Storage;
use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page

    public function home() {
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //change password page

    public function changePasswordPage() {
        return view('user.password.change');
    }

    //change password

    public function changePassword(Request $request) {
        $this->passwordValidationCheck($request);
        $currentUserId = Auth::user()->id;

        $user = User::select('password')->where('id',$currentUserId)->first();

        $dbHashValue = $user->password;

        $clientPassword = Hash::make('kophyo');

        if(Hash::check($request->oldPassword,$dbHashValue)){
            User::where('id',$currentUserId)->update([
                'password' => Hash::make($request->newPassword),
            ]);

            // Auth::logout();

            // return redirect()->route('auth#loginPage');

            return back()->with(['changeSuccess' => 'Password Change Success!']);
        }

        return back()->with(['notMatch' => 'The Old Password Not Match. Try Again!']);
    }

    //account change page

    public function accountChangePage() {
        return view('user.profile.account');
    }


    //filter  pizza

    public function filter($id) {
        $pizza = Product::where('categories_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //account change

    public function accountChange(Request $request,$id) {
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        //for image

        if($request->hasFile('image')){
            $dbImage =User::where('id',$id)->first();
            $dbImage =$dbImage->image;

            if($dbImage != null) {
                Storage::delete('public/'.$dbImage);
            }


            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;

        }
        User::where('id',$id)->update($data);
        return back()->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    //direct pizza details

    public function pizzaDetails($pizzaId) {

        $pizza = Product::where('id',$pizzaId)->first();
        $pizzaList = Product::get();

        // dd($pizzaList);
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //cart list

    public function cartList() {
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price as pizza_price','products.image as pizza_image')
        ->leftJoin('products','products.id','carts.products_id')
        ->where('carts.user_id',Auth::user()->id)->get();

        $totalPrice = 0;
        foreach($cartList as $cl) {
            $totalPrice += $cl->pizza_price*$cl->qty;
        };
        return view('user.main.cart',compact('cartList','totalPrice'));
    }


    //direct history page

    public function history() {
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(6);
        return view('user.main.history',compact('order'));
    }

    //direct user list page

    public function userList(){
        $users = User::where('role','user')->paginate(3);
        return view('admin.user.userList',compact('users'));
    }

    //change user role

    public function userChangeRole(Request $request) {
        $updateSource = [
            'role' => $request->role
        ];
        User::where('id',$request->userId)->update($updateSource);

    }

    //delete user list

    public function userDelete($id) {
        $deleteData = User::where('id',$id)->delete();
        return back();
    }




    // request user data

    private function getUserData($request) {
        return[
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }


    //password validation check

    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword' => 'required|min:6|max:10',
            'newPassword' => 'required|min:6|max:10',
            'confirmPassword' => 'required|min:6|same:newPassword|max:10'
        ])->validate();
    }

    // account Validation Check

    private function accountValidationCheck($request) {
        Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'gender' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required',

        ])->validate();
    }

}
