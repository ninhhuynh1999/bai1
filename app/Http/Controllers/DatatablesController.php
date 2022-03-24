<?php

namespace App\Http\Controllers;

use App\ShippingUnit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('datatables.index');
    }

    
    /**
     * Test function
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->from_date)) {
                $data = DB::table('users')
                    ->whereBetween('created_at', array($request->from_date, $request->to_date))
                    ->get();
            } else {
                $data = DB::table('users')
                    ->get();
            }
            return datatables()->of($data)->make(true);
        }
        return view('home');
    }
    /**
     * Test function
     */
    public function anyData(Request $request)
    {
        return Datatables::of(User::all())->make(true);
    }

}
