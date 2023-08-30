<?php

namespace Laborb\BunnyStream\Http\Controllers\Cp;

use Illuminate\Http\Request;
use Statamic\Http\Controllers\CP\CpController;
use Illuminate\Support\Facades\Http;

final class BunnyController extends CpController
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    public function index()
    {
        return view('bunny::index');
    }
}