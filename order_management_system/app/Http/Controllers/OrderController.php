<?php

namespace App\Http\Controllers;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        //
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
