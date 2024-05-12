<?php

namespace App\Http\Controllers;

use App\Models\Memo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MemoController extends Controller
{
  /**
   * 初期表示
   *
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
    public function index()
    {
      $memos = Memo::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();

      return view('memo', [
        'name' => $this->getLoginUserName(),
        'memos' => $memos,
        'select_memo' => session()->get('select_memo')
      ]);
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

  /**
   * メモの選択
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function select(Request $request): RedirectResponse
  {
    $memo = Memo::find($request->id);
    session()->put('select_memo', $memo);

    return redirect()->route('memo.index');
  }

  /**
   * メモの削除
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function delete(Request $request): RedirectResponse
  {
    Memo::find($request->edit_id)->delete();
    session()->remove('select_memo');

    return redirect()->route('memo.index');
  }

  /**
   * ログインユーザー名取得
   *
   * @return string
   */
  private function getLoginUserName(): string
  {
    $user = Auth::user();
    $name = '';

    if ($user) {
      if (7 < mb_strlen($user->name)) {
        $name = mb_substr($user->name, 0, 7) . "...";
      } else {
        $name = $user->name;
      }
    }

    return $name;
  }
}
