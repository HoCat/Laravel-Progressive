<?php


use Illuminate\Http\Request;
use SwooleTW\Http\Websocket\Facades\Websocket;

/*
|--------------------------------------------------------------------------
| Websocket Routes
|--------------------------------------------------------------------------
|
| Here is where you can register websocket events for your application.
|
*/

Websocket::on('connect', function ($websocket, Request $request) {
    // called while socket on connect
    $websocket->emit('message', '我是大哥');
});

Websocket::on('disconnect', function ($websocket) {
    // called while socket on disconnect
});

Websocket::on('woshidage', function ($websocket, $data) {
    $websocket->emit('message', $data);
});
