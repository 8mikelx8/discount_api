<?php

namespace App\Test\TestCase\Controllers;

use Miquel\DiscountApi\Controllers\ProductsController;
use Miquel\DiscountApi\Services\ProductService;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7\Response as Response;
use Slim\Factory\AppFactory;
use Slim\Factory\ServerRequestCreatorFactory;

class ProductTest extends TestCase
{
    public function testInvoke(): void
    {
        $service = $this->createMock(ProductService::class);
        $service
            ->expects(self::once())
            ->method('getAllProducts')
            ->with(1,'sandals',100000)
            ->willReturn(['mockedServiceResponse']);
        
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request = $serverRequestCreator->createServerRequestFromGlobals()->withQueryParams(['offset'=> 1, 'category' => 'sandals', 'priceLessThan' => 100000]);
        
        $response = new Response();

        $controller = new ProductsController($service);
        $controllerResponse = $controller($request, $response);
        $this->assertInstanceOf(Response::class, $controllerResponse);
        $this->assertEquals(['mockedServiceResponse'], json_decode($controllerResponse->getBody()));
        $this->assertEquals(200, $controllerResponse->getStatusCode());
    }

    public function testReturnsNotFound(): void
    {
        $service = $this->createMock(ProductService::class);
        $service
            ->expects(self::once())
            ->method('getAllProducts')
            ->with(1,'sandals',100000)
            ->willReturn([]);
        
        $serverRequestCreator = ServerRequestCreatorFactory::create();
        $request = $serverRequestCreator->createServerRequestFromGlobals()->withQueryParams(['offset'=> 1, 'category' => 'sandals', 'priceLessThan' => 100000]);
        
        $response = new Response();

        $controller = new ProductsController($service);
        $controllerResponse = $controller($request, $response);
        $this->assertInstanceOf(Response::class, $controllerResponse);
        $this->assertEmpty(json_decode($controllerResponse->getBody()));
        $this->assertEquals(404, $controllerResponse->getStatusCode());
    }
}