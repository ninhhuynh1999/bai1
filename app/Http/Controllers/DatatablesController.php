<?php

namespace App\Http\Controllers;

use App\ShippingUnit;
use App\User;
use Illuminate\Http\Request;
// use Datatables;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function getIndex()
    {
        return view('datatables.index');
    }

    public function anyData()
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
}
