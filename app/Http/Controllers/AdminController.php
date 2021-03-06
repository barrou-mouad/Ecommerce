<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Categorie;
use App\Models\Commande;
use App\Models\Produit;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
    return view('admin.home')->with( ['cat'=> count(Categorie::all()),'prod'=> count(Produit::all()),'user'=>count(User::all()),'cmd'=>count(Commande::all())]);
    }
    public function catlist(){
        return view('admin.catlist');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashbord');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('admin.loginpage');

}
}
