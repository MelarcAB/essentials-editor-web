<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Metadata;

class MetadataController extends Controller
{
    //index
    public function index()
    {
        $metadata = new Metadata();
        $data = $metadata->loadData();
        return view('metadata.index' , compact('data'));
    }
}
