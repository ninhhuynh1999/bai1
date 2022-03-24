<?php

namespace App\Http\Controllers;

use App\ShippingUnit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class DatatablesController extends Controller
{
    public function getIndex()
    {
        return view('datatables.index');
    }

    public function getAllShippingUnit(Request $request)
    {
        $targetColumn = ['created_at', 'updated_at'];
        if (!request()->ajax()) {
            return response()->json(['error' => 'Error: Only accepted AJAX request'], 404); // Status code here
        }
        if (!empty($request->from_date) || in_array($request->optionDate, $targetColumn)) {

            $data = ShippingUnit::with('status', 'created_by', 'updated_by')
                ->whereBetween($request->optionDate, array($request->from_date, $request->to_date))
                ->get();
        } else {
            $data = ShippingUnit::with('status', 'created_by', 'updated_by')->get();
        }
        return Datatables::of($data)->make(true);
        // return Datatables::of($data)->make(true);
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


    private function mapShippingUnit(ShippingUnit $model)
    {
        // $model->

        return ;
    }
}
