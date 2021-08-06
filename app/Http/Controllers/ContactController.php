<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function create(){
      $details=[
          'title'=>'test from Ecommerce',
          'body' => 'welcome in our site web'
      ];
      Mail::to('m.barrou99@gmail.com')->send(new ContactMail($details));

  }
}
