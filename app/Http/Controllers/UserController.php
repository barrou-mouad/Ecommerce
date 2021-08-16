<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Return_;

class UserController extends Controller
{
    public function updatepassword(Request $req){

  $req->validate(
  [ 'current_password' => 'required',
    'new_password' => 'required|min:6|max:15',
    'confirm_password'=> 'required|same:new_password'
 ],
 [
    'confirm_password.same'=>'Les deux Nouveau mot de passe et Confirmer mot de passe champs ne sont pas identiques'
 ]
  );
  $user=User::find(Auth::guard('web')->user()->id);
if(Hash::check($req->current_password,$user->password)){
      $user->password = Hash::make($req->new_password);
      $user->save();
    return redirect()->route('user.setting')->with(['success'=>'Le mot de passe est bien modifié']);
    }
    else{
        return back()->with([
            'error'=>'waloooooooooooooooooooooooo'
        ]);
    }

    }
    public function  editpassword(){
        return view('user.editpassword');
    }
    public function  edit(){
        return view('user.editprofil');
    }
    public function  settingpage(){
        return view('user.setting');
    }
    public function update(Request $req){
    $user=User::find(Auth::guard('web')->user()->id);
if($req->email!=$user->email){
    $req->validate(
        [ 'name' => 'required',
          'email' => 'required|email|unique:users',
          'number_phone'=> 'required',
          'address'=> 'required'
       ],
       [
          'email.unique'=>'ce email existe déja'
       ]
        );
    }
    else{
        $req->validate(
            [ 'name' => 'required',
              'email' => 'required|email',
              'number_phone'=> 'required',
              'address'=> 'required'
           ],
           [
              'email.unique'=>'ce email existe déja'
           ]
            );
    }

        $user->name=$req->name;
        $user->email=$req->email;
        $user->number_phone=$req->number_phone;
        $user->address=$req->address;
        $res=$user->save();
        if($res){
        return redirect()->route('user.setting')->with(['success'=>'les données sont bien modifiés ']);
        }
        else{
            return redirect()->back()->with(['error'=>'les donneés ne sont pas modifiés essayer autre fois']);
        }

    }
    public function commandes(){
        foreach (Auth::user()->unreadNotifications as $notification) {
            $notification->markAsRead();
        }
        return view('user.commandes');
    }
    public function add(Request $req){
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'number_phone' => 'required|string',
            'address' => 'required|string']
        );
            User::create([
            'name' => $req->name,
            'email' => $req->email,
            'password' => Hash::make($req->password),
            'address' => $req->address,
            'number_phone' => $req->number_phone,
        ]);
        return redirect()->route('admin.userlist');
    }
    public function updateFromAdmin(Request $req){
        $user=User::find($req->id);
    if($req->email!=$user->email){
        $req->validate(
            [ 'name' => 'required',
              'email' => 'required|email|unique:users',
              'number_phone'=> 'required',
              'address'=> 'required'
           ],
           [
              'email.unique'=>'ce email existe déja'
           ]
            );
        }
        else{
            $req->validate(
                [ 'name' => 'required',
                  'email' => 'required|email',
                  'number_phone'=> 'required',
                  'address'=> 'required'
               ],
               [
                  'email.unique'=>'ce email existe déja'
               ]
                );
        }
            $user=User::find($req->id);
            $user->name=$req->name;
            $user->email=$req->email;
            $user->number_phone=$req->number_phone;
            $user->address=$req->address;
            $res=$user->save();
            if($res){
            return redirect()->route('admin.userlist')->with(['success'=>'les données sont bien modifiés ']);
            }
            else{
                return redirect()->back()->with(['error'=>'les donneés ne sont pas modifiés essayer autre fois']);
            }

        }

}
