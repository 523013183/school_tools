<?php

namespace App\Api\Controllers;

use App\Api\Services\ApiService;
use App\Base\Controllers\ApiBaseController;
use Illuminate\Http\Request;

class ApiController extends ApiBaseController
{
    private $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
}
