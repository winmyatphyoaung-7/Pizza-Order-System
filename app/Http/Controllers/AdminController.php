<?php

namespace App\Http\Controllers;

use Storage;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // change password page

    public function changePasswordPage() {
        return view('admin.account.changePassword');
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

    //direct admin details page

    public function details() {
        return view('admin.account.details');
    }

    //direct admin profile page

    public function edit() {
        Auth::user()->id;
        return view('admin.account.edit');
    }

    //update account

    public function update($id,Request $request) {
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
        return redirect()->route('admin#details')->with(['updateSuccess' => 'Admin Account Updated...']);
    }

    //admin list

    public function list() {
        $admin = User::where('role','admin')->paginate(3);
                //   $admin->appends(request()->all());
        return view('admin.account.list')->with(compact('admin'));
    }

    //admin delete

    public function delete($id) {
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Admin Account Deleted']);
    }


    //ajax change role

    public function ajaxChangeRole(Request $request) {
        $updateSource = [
            'role' => $request->role
        ];

        User::where('id',$request->id)->update($updateSource);

    }

    //request user data

    private function requestUserData($request) {
        return[
            'role' => $request->role,
        ];
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
