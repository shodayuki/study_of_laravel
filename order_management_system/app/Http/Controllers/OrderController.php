<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderStoreRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
