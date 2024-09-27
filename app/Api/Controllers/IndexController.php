<?php

namespace App\Api\Controllers;

use App\Api\Services\ApiService;
use App\Base\Controllers\ApiBaseController;
use Illuminate\Http\Request;

class IndexController extends ApiBaseController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index(Request $request)
    {
        dd(222);
    }
}
