<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
  function index(){
    $users = User::all();
    return view('admin.user.index',['users' => $users]);
  }
  function newuser(){
    return view('admin.user.new');
  }
  function create(Request $request){
    $this->validate($request,
      [
        'name' => 'required', 
        'email' => 'required|email', 
        'password' => 'required', 
        'repassword' => 'required|same:password', 
        'address' => 'required', 
        'phone' => 'required'
      ],
      [
        'name.required' => 'Name cant be blank',
        'email.required' => 'Name cant be blank',
        'email.email' => 'Email is not exactly format',
        'password.required' => 'Password cant be blank',
        'repassword.same' => 'RePassword is not same password',
        'repassword.required' => 'RePassword cant be blank',
        'address.required' => 'Address cant be blank',
        'phone.required' => 'Phone cant be blank',
      ]
    );

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->address = $request->address;
    $user->phone = $request->phone;
    $user->role = $request->role;
    $user->save();
    return redirect('admin/user/index')->with('success','Create successfully');
  }
  function edit($id){
    $user = User::find($id);
    return view('admin/user/edit', ['user' => $user]);
  }
  function update($id, Request $request){
    $this->validate($request,
      [
        'name' => 'required', 
        'address' => 'required', 
        'phone' => 'required'
      ],
      [
        'name.required' => 'Name cant be blank',
        'address.required' => 'Address cant be blank',
        'phone.required' => 'Phone cant be blank',
      ]
    );

    $user = User::find($id);
    if ($request->changePassword == "on") {
      $this->validate($request,
        [
          'password' => 'required', 
          'repassword' => 'required|same:password', 
        ],
        [
          'password.required' => 'Password cant be blank',
          'repassword.same' => 'RePassword is not same password',
          'repassword.required' => 'RePassword cant be blank'
        ]
      );
      $user->password = bcrypt($request->password);
    }
    $user->name = $request->name;
    $user->address = $request->address;
    $user->phone = $request->phone;
    $user->role = $request->role;
    $user->save();
    return redirect('admin/user/edit/'.$id)->with('success','Edit successfully');
  }
  function delete($id){
    $user = User::find($id);
    $user->delete();
    return redirect('admin/user/index')->with('success','Delete successfully');
  }
}
