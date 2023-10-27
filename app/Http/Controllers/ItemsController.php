<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Items;

class ItemsController extends Controller
{
    public function index()
    {
        $items_obj = new Items();
        $data =  $items_obj->loadData();

        return view('items.index', compact('data'));
    }
}
