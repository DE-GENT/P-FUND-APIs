<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        return response()->json(ActivityLog::with('user:id,name,email')->latest()->get());
    }
}
