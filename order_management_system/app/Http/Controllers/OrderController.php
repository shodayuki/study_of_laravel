<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Resources\OrderResource;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Pen;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
  /**
   * @return \Illuminate\Http\JsonResponse
   */
    public function index():JsonResponse
    {
        $orderQuery = Order::orderBy('id', 'desc');
        $orderPaginator = $orderQuery->paginate(4);
        $orders = OrderResource::collection($orderPaginator->items());

        return response()->json([
          'data' => $orders,
          'meta' => [
            'current_page' => $orderPaginator->currentPage(),
            'per_page' => $orderPaginator->perPage(),
            'total' => $orderPaginator->total(),
            'next_page_url' => $orderPaginator->nextPageUrl(),
            'prev_page_url' => $orderPaginator->previousPageUrl(),
          ],
        ], 200);
    }

  /**
   * @return JsonResponse
   */
    public function create(): JsonResponse
    {
        $pens = Pen::all();
        $customers = Customer::all();

        return response()->json([
            'pens' => $pens,
            'customers' => $customers,
        ], 200);
    }

  /**
   * @param OrderStoreRequest $request
   * @return JsonResponse
   */
    public function store(OrderStoreRequest $request): JsonResponse
    {
        $order = new Order();
        $order->pen_id = $request->pen_id;
        $order->customer_id = $request->customer_id;
        $order->num = $request->num;
        $order->shipping = 0;
        $order->orderday = date('Y-m-d H:i:s');
        $order->save();

        return response()->json([
          'data' => $order,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

  /**
   * @param $id
   * @return JsonResponse
   */
    public function edit($id): JsonResponse
    {
        $pens = Pen::all();
        $customers = Customer::all();
        $order = Order::find($id);

        return response()->json([
          'data' => $order,
          'pens' => $pens,
          'customers' => $customers
        ]);
    }

  /**
   * @param OrderStoreRequest $request
   * @param Order $order
   * @return JsonResponse
   */
    public function update(OrderStoreRequest $request, Order $order): JsonResponse
    {
        $order->fill($request->all());
        $order->save();

        return response()->json([
            'data' => $order
        ], 200);
    }

  /**
   * @param Order $order
   * @return JsonResponse
   */
    public function delete(Order $order): JsonResponse
    {
        $order->delete();

        return response()->json([
            'message' => '無事に削除しました'
        ], 200);
    }
}
