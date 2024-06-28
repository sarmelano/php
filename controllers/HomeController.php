<?php


class HomeController
{
    public function index()
    {
        Auth::protect();
        view('home');
    }
}