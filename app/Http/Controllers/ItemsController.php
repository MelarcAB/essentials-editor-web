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

    public function show($IdName)
    {
        $items_obj = new Items();
        $item =  $items_obj->searchItem($IdName);

        return view('items.show', compact('item'));
    }
}
