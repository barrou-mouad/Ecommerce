<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function create(Request $req){
      $details=[
          'subject'=>$req->subject,
          'body' => $req->body
      ];
      Mail::to($req->email)->send(new ContactMail($details));
     return back()->with(['success' => 'Le message est envoyé']);
  }
}
