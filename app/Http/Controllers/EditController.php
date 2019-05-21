<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class EditController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function update(Request $request, User $user)
 {
   $validate_rule = [
     'name' => 'required','unique:users'
   ];
   $this->validate($request, $validate_rule);

   $user = Auth::user();
   $form = $request->all();
   unset($form['_token']);
   $user->fill($form)->save();

   $header_img = $request->header_img;
   if(!empty($header_img)){
   $user->header_img = $request->header_img->storeAs('images',$request->user()->id.'.jpg');
   }
   $icon_img = $request->icon_img;
   if(!empty($icon_img)){
   $user->icon_img = $request->icon_img->storeAs('images',$request->user()->id.'icon.jpg');
   }

   $user->area = $request->area;

   $user->save();
   return redirect('mypage/edit');
 }

}
