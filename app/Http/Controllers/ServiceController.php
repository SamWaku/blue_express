<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parcels;
use App\Models\User;
use App\Notifications\ParcelStatusNotification;
use Illuminate\Support\Facades\Notification;

class ServiceController extends Controller
{
    //This controller contains all features of the courier website

    //Submitting a parcel
    public function submitParcel(Request $request){
        $fields = $request->validate([
         'From' => 'required|string',
         'To' => 'required|string',
         'ShipDetails' => 'required|string',
         'Weight' => 'required|string',
         'Phone' => 'required|string',
         'Email' => 'required|string',
         'FirstName' => 'required|string',
         'LastName' => 'required|string',
         ]);
         
 
          function generatePin(){
              $numbers = 10;
              $pins = array();
              for($j = 0; $j < $numbers; $j++){
                  $characters = 'ABCDEFGHIJKLMNOPQRTUVWXYZ';
 
                  //generate a pin based on 2 * 7 digits + a random character
                  $pin = mt_rand(1000000, 9999999)
                        .mt_rand(1000000, 9999999)
                        .$characters[rand(0, strlen($characters) - 1)];
 
                        $string = str_shuffle($pin);
              }
              return $string;   
         }
         
         //access the current logged in user
          $user_id = User::where('email', $fields['Email'])->value('id');
 
          
         //submit parcel 
         $parcel = parcels::create([
             'From' => $fields['From'],
             'To' => $fields['To'],
             'ShipDetails' => $fields['ShipDetails'],
             'Weight' => $fields['Weight'],
             'Phone' => $fields['Phone'],
             'Email' => $fields['Email'],
             'FirstName' => $fields['FirstName'],
             'LastName' => $fields['LastName'],
             'Reference' => generatePin(),
             'user_id' => $user_id
         ]);
        //access the reference number of the parcel submited   
        $reference = parcels::where('Weight', $fields['Weight'])->value('Reference');
      
         return response()->json($reference, 201);
 
     }
 
     //Checking status of a parcel
     public function checkStatus(Request $request){
        
         //get status using a Reference number
        $status = parcels::where('Reference', $request->Reference)->value('Status');
        $reference = parcels::where('Reference', $request->Reference)->value('Reference');
        //get current user to notify
        $id = parcels::where('Reference', $request->Reference)->value('user_id');
        $users = User::where('id', $id)->first();
        
        Notification::sendNow($users, new ParcelStatusNotification($status, $reference));
 
        foreach ($users->notifications as $notification) {
 
         
         return response()->json($notification->data, 201);
     }
  }

     public function parcelStatus(Request $request){
         $id = parcels::where('Status', 'has been shipped')->value('user_id');
         $parcel = parcels::where('user_id', $id)->count('Status');

         return response()->json($parcel, 201);


     } 
}
