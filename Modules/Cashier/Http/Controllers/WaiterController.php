<?php

namespace Modules\Cashier\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Restaurant\Models\Waiter;

class WaiterController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:waiters-create')->only(['create', 'store']);
        $this->middleware('permission:waiters-read')->only(['index', 'show']);
        $this->middleware('permission:waiters-update')->only(['edit', 'update']);
        $this->middleware('permission:waiters-delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waiters = Waiter::orderBy('status', 'DESC')->get();
        return view('cashier::waiters.index', compact('waiters'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waiter  $waiter
     * @return \Illuminate\Http\Response
     */
    public function show(Waiter $waiter)
    {
        return view('cashier::waiters.show', compact('waiter'));
    }
}
