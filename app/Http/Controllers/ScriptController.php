<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScriptController extends Controller
{
  public function script($script) {
      return view('js.'.$script);
  }
}
