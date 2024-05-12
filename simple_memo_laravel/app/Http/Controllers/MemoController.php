<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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

  /**
   * メモの追加
   *
   * @return RedirectResponse
   */
  public function add(): RedirectResponse
  {
      Memo::create([
        'user_id' => Auth::id(),
        'title' => '新規メモ',
        'content' => ''
      ]);

      return redirect()->route('memo.index');
    }
}
