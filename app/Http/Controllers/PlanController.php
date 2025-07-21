<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPlanRequest;
use App\Http\Requests\UpdatePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('plans.index')->with([
            'plans' => Plan::all()
        ]);
    }
}
