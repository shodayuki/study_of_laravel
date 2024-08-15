<?php

namespace App\Http\Controllers\Larashop\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Larashop\API\Me\ShowRequest;
use App\Http\Requests\Larashop\API\Me\UpdateRequest;
use App\Http\Requests\Larashop\API\Me\GetPurchasedProductsRequest;
use App\Http\Requests\Larashop\API\Me\GetPurchasedProductDealRequest;
use App\Http\Requests\Larashop\API\Me\GetListedProductsRequest;
use App\Http\Requests\Larashop\API\Me\GetListedProductDealRequest;
use App\Http\Resources\Larashop\API\DealForMyPageResource;
use App\Http\Resources\Larashop\API\MeResource;
use App\Http\Resources\Larashop\API\ProductForMyPageCollection;
use App\Models\Product;
use App\Services\Larashop\ProductService\ProductServiceInterface;
use App\Services\Larashop\UserService\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeController extends Controller
{

    /**
    * @var UserServiceInterface
    */
    private $userService;

    /**
    * @var ProductServiceInterface
    */
//    private $productService;

    /**
     * @param  UserServiceInterface  $userService
     * @param  ProductServiceInterface  $productService
     * @return void
     */
    public function __construct(
        UserServiceInterface $userService,
//        ProductServiceInterface $productService
    )
    {
        $this->userService = $userService;
//        $this->productService = $productService;
    }

    /**
     * ログインユーザー情報取得API
     * 
     * @param  ShowRequest  $request
     * @return MeResource
     */
    public function show(ShowRequest $request)
    {
        $user = Auth::user();

        return new MeResource($user);
    }

    /**
     * ログインユーザー情報更新API
     * 
     * @param  UpdateRequest  $request
     * @return MeResource
     */
    public function update(UpdateRequest $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $params = $request->safe()->toArray();

        $user = $this->userService->update($user, $params);

        return new MeResource($user);
    }

    /**
     * 購入商品一覧取得API
     * 
     * @param  GetPurchasedProductsRequest  $request
     * @return ProductForMyPageCollection
     */
//    public function getPurchasedProducts(GetPurchasedProductsRequest $request)
//    {
//        /** @var \App\Models\User $user */
//        $user = Auth::user();
//        $products = $this->productService->getPurchasedProductsByUser($user);
//
//        return new ProductForMyPageCollection($products);
//    }

    /**
     * 購入商品の取引詳細情報取得API
     * 
     * @param  GetPurchasedProductDealRequest  $request
     * @return DealForMyPageResource
     */
//    public function getPurchasedProductDeal(GetPurchasedProductDealRequest $request, Product $product)
//    {
//        $product->deal->load('dealEvents');
//        return new DealForMyPageResource($product->deal);
//    }

    /**
     * 出品商品一覧取得API
     * 
     * @param  GetListedProductsRequest  $request
     * @return ProductForMyPageCollection
     */
//    public function getListedProducts(GetListedProductsRequest $request)
//    {
//        /** @var \App\Models\User $user */
//        $user = Auth::user();
//        $products = $this->productService->getListedProductsByUser($user);
//
//        return new ProductForMyPageCollection($products);
//    }

    /**
     * 出品商品の取引詳細情報取得API
     * 
     * @param  GetListedProductDealRequest  $request
     * @return DealForMyPageResource
     */
//    public function getListedProductDeal(GetListedProductDealRequest $request, Product $product)
//    {
//        $product->deal->load('dealEvents');
//        return new DealForMyPageResource($product->deal);
//    }

}
