<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class MainController extends Controller
{
    //
    public function index(){
    	return view('static.landingpage');
    }

    public function register(Request $request){

    	$request->validate([
    		'subscription_type' => ["required","regex:(type1|type2|type3)"],
    		'link'	=> "required",
    		'fname' => 'required',
    		'lname' => 'required',
    		'email' => 'required',
    		'companyname' => 'required',
    		'password' => 'required|confirmed',
    		'password_confirmation' => 'required',
    	],
        [
    		'fname.required' => "First name is required",
    		'lname.required' => "Last name is required",
    		'companyname.required' => "Company name is required",
    		'password_confirmation.required' => 'Please confirm your password',
    	]);

    	$res = guzzle('POST', 'http://localhost/tams/adminbackend/api/register', [ 'form_params' => [
    			'fname' => $request->post('fname'),
    			'lname' => $request->post('lname'),
    			'email' => $request->post('email'),
    			'companyname' => $request->post('companyname'),
                'password' => $request->post('password'),
    			'password_confirmation' => $request->post('password_confirmation'),
    			'subscription_type' => $request->post('subscription_type'),
    			'link' => $request->post('link')
    		]
    	]);

        if($res->status){
            return back()->with(['status'=>$res->status]);
        }else{
            return back()->withErrors($res->errors)->with(['status'=>$res->status]);
        }

    }
}
