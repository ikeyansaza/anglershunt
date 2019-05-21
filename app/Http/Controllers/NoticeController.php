<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Newspost;

class NoticeController extends Controller
{
  public function __construct()
  {
      $this->middleware('admin');
  }
}
