<?php

namespace App\Http\Controllers;

use App\ShippingUnit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Datatables;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function getIndex()
    {
        return view('datatables.index');
    }

    public function anyData(Request $request)
    {
        return Datatables::of(User::all())->make(true);
    }
    public function getAllShippingUnit()
    {
        $data = ShippingUnit::with('status','created_by','updated_by')->get();

        // dd( json_encode($data) );
        // $temp = json_encode($data,1);

        return Datatables::of($data)->make(true);
    }

    public function index(Request $request)
    {
        if(request()->ajax())
        {
         if(!empty($request->from_date))
         {
          $data = DB::table('users')
            ->whereBetween('created_at', array($request->from_date, $request->to_date))
            ->get();
         }
         else
         {
          $data = DB::table('users')
            ->get();
         }
         return datatables()->of($data)->make(true);
        }
        return view('home');
    }
}
