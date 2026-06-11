<?php

namespace App\Http\Controllers;

use App\Models\CommissionHistory;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{  

public function index(Request $request){
    $sort_search = null;
    $data = Contact::orderBy('id', 'desc');
    if($request->search != null){
        $sort_search = $request->search;
        $data = $data->where('name','like','%'.$sort_search.'%')->orwhere('email','like','%'.$sort_search.'%')->orwhere('phone','like','%'.$sort_search.'%');
    }
    $data = $data->paginate(15);
    return view('backend.contactus-list', compact('data','sort_search'));
}

public function store(Request $request){
    $request->validate([
        'firstname' => 'required',
        'lastname' => 'required',
        'number' => 'required|numeric|digits:10',
        'email' => 'required|email',
    ]);
    $data = new Contact;
    $data->firstname = $request->firstname;
    $data->lastname =$request->lastname;
    $data->number =$request->number;
    $data->email =$request->email;
    $data->message =$request->message;
    $data->save();
    return back()->with('success', 'Thank You For Contact!');


}
}