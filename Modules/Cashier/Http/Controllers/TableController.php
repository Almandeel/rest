<?php

namespace Modules\Cashier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Restaurant\Models\Table;
class TableController extends Controller
{
    /**
    * Check if user have permission in every request
    *
    * @return Response
    * @throws \Illuminate\Auth\Access\AuthorizationException
    */
    public function __construct()
    {
        $this->middleware('permission:tables-read')->only(['index', 'show']);
        $this->middleware('permission:tables-update')->only(['update']);
    }
    
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $tables = Table::all();
        
        return  view('cashier::tables.index', compact('tables'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return  view('cashier::tables.show', compact('table'));
    }
}