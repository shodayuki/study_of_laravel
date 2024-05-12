<?php

namespace App\Http\Controllers;

class MemoController extends Controller
{
  /**
   * 初期表示
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
    public function index()
    {
      return view('memo');
    }
}
