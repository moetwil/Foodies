<?php
require __DIR__ . '/controller.php';

class FavouritesController extends Controller
{
    public function index()
    {
        $this->displayView(null);
    }
}