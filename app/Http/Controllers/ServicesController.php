<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\parcels;
use App\Models\User;
use App\Models\shipping;


class ServicesController extends Controller
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
        'Status' => 'required|string'
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
         $user = User::where('email', $fields['Email'])->value('id');
         
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
            'Status '=> $fields['Status'],
            'idUsers' => $user
        ]);


        return response()->json($parcel, 201);

    }


}
