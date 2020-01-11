<?php


namespace App\Controllers;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController
{
    public function index(Request $request)
    {
        return new Response('awewae',200);
    }
}
