<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //get all product list

    public function productList() {

        $user = User::get();

        $data = [
            'user' => $user
        ];
        return response()->json($data,200);
    }

    //get category list

    public function categoryList(){
        $category = Category::get();
        return response()->json($category,200);
    }

    //category create

    public function categoryCreate(Request $request){
        $data = [
            "name" => $request->name,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response,200);

    }

    //contact create

    public function contactCreate(Request $request) {
       $data = $this->getContactData($request);
        Contact::create($data);
        $response = Contact::orderBy('created_at','desc')->get();

       return response()->json($response,200);
    }

    //contact delete

    public function contactDelete(Request $request){
        $data = Contact::where('id',$request->id)->first();
        if(isset($data)) {
            Contact::where('id',$request->id)->delete();
            return response()->json(["status" => "true","message" => "Delete Success"],200);
        }else{
            return response()->json(["status" => "false" ,"message" => "There is no Contact"],200);
        }
    }

    //contact detail

    public function contactDetail($id) {
        $data = Contact::where('id',$id)->first();
        if(isset($data)) {
            return response()->json(["status" => "true","contact" => $data ],200);
        }else{
            return response()->json(["status" => "false" ,"message" => "There is no Contact"],200);
        }
    }

    //contact update

    public function contactUpdate(Request $request){
        $data = Contact::where('id',$request->contactId)->first();

        if(isset($data)) {
            $updateData = $this->getUpdateData($request);
            Contact::where('id',$request->contactId)->update($updateData);
            $response = Contact::where('id',$request->contactId)->first();

            return response()->json(['status' => 'true','message' => 'Contact Update success','contact' => $response],200);
        }

        return response()->json(['status' => 'false','message' => 'There is no contact to update'],200);
    }

    //get contact data

    private function getContactData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'message' => $request->message,

        ];
    }

    //get update data

    private function getUpdateData($request){
        return [
            'name' => $request->contactName,
            'email' => $request->contactEmail,
            'phone' => $request->contactPhone,
            'address' => $request->contactAddress,
            'message' => $request->contactMessage,
            'updated_at' => Carbon::now()
        ];
    }
}
