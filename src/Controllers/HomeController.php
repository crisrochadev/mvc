<?php

namespace Src\Controllers;

class HomeController extends Controller
{
    public static function index()
    {
        self::layout('main');
        echo self::view('home');
    }
    public static function getStart()
    {
        self::layout('main');
        echo self::view('get-start');
    }

    public static function store($name)
    {
        return "Name: " . htmlspecialchars($name);
    }

    public static function create($id, $data)
    {
        return json_encode($data);
    }
}
