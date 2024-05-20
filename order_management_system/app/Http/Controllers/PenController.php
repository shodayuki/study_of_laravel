<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenStoreRequest;
use App\Models\Pen;
use Illuminate\Http\Request;

class PenController extends Controller
{
    /**
     * 一覧表示
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
      $pens = Pen::all();

      return response()->json([
        'data' => $pens
      ],200);
    }

    /**
     * 登録
     *
     * @param PenStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PenStoreRequest $request): \Illuminate\Http\JsonResponse
    {
      $pen = new Pen();

      $pen->name = $request->name;
      $pen->price = $request->price;
      $pen->save();

      return response()->json([
        'data' => $pen
      ],201);
    }

    /**
     * 指定のデータのみ取得
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id): \Illuminate\Http\JsonResponse
    {
      $pen = Pen::find($id);

      return response()->json([
        'data' => $pen
      ], 200);
    }

    /**
     * 更新
     *
     * @param Request $request
     * @param Pen $pen
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Pen $pen): \Illuminate\Http\JsonResponse
    {
      $pen->fill($request->all());
      $pen->save();

      return response()->json([
        'data' => $pen
      ], 200);
    }

    /**
     * 削除
     *
     * @param Pen $pen
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Pen $pen): \Illuminate\Http\JsonResponse
    {
      $pen->delete();

      return response()->json([
        'message' => '無事に削除しました'
      ], 200);
    }
}
