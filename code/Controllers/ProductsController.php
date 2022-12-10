<?php

namespace Miquel\DiscountApi\Controllers;

use Miquel\DiscountApi\Services\ProductService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ProductsController
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function __invoke(Request $request, Response $response)
    {
        $params = $this->getParams($request);
        $products = $this->productService->getAllProducts($params['offset'],$params['category'],$params['priceLessThan']);
        $response->getBody()->write(json_encode($products));
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    protected function getParams(Request $request): array
    {
        $queryParams = $request->getQueryParams();
        $params =  [
            'offset' => 0,
            'category' => null,
            'priceLessThan' => null
        ];
        if (isset($queryParams['offset'])) {
            $params['offset'] = (int) $queryParams['offset'];
        }
        if (isset($queryParams['category'])) {
            $params['category'] = $queryParams['category'];
        }
        if (isset($queryParams['priceLessThan'])) {
            $params['priceLessThan'] = (int) $queryParams['priceLessThan'];
        }
        return $params;
    }
}