<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class GMaps extends Controller {

  public function open()
  {
    return view('gmaps.open');
  }

}