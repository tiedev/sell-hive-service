<?php

session_start();

require_once 'vendor/autoload.php';
require_once 'propel/config.php';

use OpenApi\Annotations as OA;

/**
 * Swagger PHP: https://github.com/zircote/swagger-php
 * OpenAPI Specification: https://swagger.io/specification/
 *
 * @OA\Info(title="Sell-Hive API", version="1.0.0")
 */
$app = new SellHiveApp();


// === AuthController ===
$app->get('/auth', ['AuthController', 'isAuthenticated']);

$app->post('/auth', ['AuthController', 'login']);

$app->delete('/auth', ['AuthController', 'logout']);

$app->post('/auth/remind', ['AuthController', 'remind']);


/** CashPointController **/
$app->get('/cashpoint/export/sellers/{secret}', ['CashpointController', 'exportSellers']);

$app->get('/cashpoint/export/items/{secret}', ['CashpointController', 'exportItems']);

$app->post('/cashpoint/confirm/transfer/{secret}', ['CashpointController', 'confirmTransfer']);

$app->post('/cashpoint/confirm/sold/{secret}', ['CashpointController', 'confirmSold']);


/** ConfigController **/
$app->get('/configuration/writeProtectionTime', ['ConfigController', 'getWriteProtectionTime']);


/** ItemController **/
$app->get('/item/count', ['ItemController', 'getCount']);

$app->get('/item', ['ItemController', 'listUserItems']);

$app->get('/items', ['ItemController', 'listAllItems']);

$app->post('/item', ['ItemController', 'createItem']);

$app->get('/item/{id}', ['ItemController', 'getItem']);

$app->post('/item/{id}', ['ItemController', 'editItem']);

$app->delete('/item/{id}', ['ItemController', 'deleteItem']);


/** PdfController **/
$app->post('/pdf/label/item', ['PdfController', 'genLabelItemPdf']);

$app->post('/pdf/label/test', ['PdfController', 'genLabelTestPdf']);

$app->get('/pdf/label/settings', ['PdfController', 'getLabelSettings']);

$app->post('/pdf/label/settings', ['PdfController', 'setLabelSettings']);

$app->get('/pdf/list/item', ['PdfController', 'genItemList']);

$app->get('/pdf', ['PdfController', 'list']);


/** SellerController **/
$app->get('/sellers', ['SellerController', 'list']);

$app->get('/seller/{id:[0-9]+}', ['SellerController', 'get']);

$app->post('/seller/{id:[0-9]+}', ['SellerController', 'edit']);

$app->post('/seller', ['SellerController', 'create']);


/** SellerLimitController **/
$app->get('/seller/limit', ['SellerLimitController', 'get']);

$app->post('/seller/limitRequest', ['SellerLimitController', 'openRequest']);

$app->delete('/seller/limit/{secret}', ['SellerLimitController', 'resetLimits']);


// === Swagger ===
$app->get('/api', ['SwaggerController', 'show']);

$app->get('/swagger.json', ['SwaggerController', 'config']);


$app->run();
