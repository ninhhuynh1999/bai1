<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShippingUnitRequest;
use App\Http\Requests\EditSphippingUnitRequest;
use App\ShippingUnit;
use App\StatusShippingUnit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ShippingUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        return view('admin.shipping_unit.index');
    }

    public function create()
    {
        $statusList = StatusShippingUnit::all();

        return view('admin.shipping_unit.create', ['statusList' => $statusList]);
    }

    public function store(CreateShippingUnitRequest $request)
    {

        $shippingUnit =  ShippingUnit::create([
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'shortName' => $request->shortName,
            'taxId' => $request->taxId,
            'status_id' => intval($request->status_id),
            'dateStopContact' => $request->status_id == 2 ? $request->dateStopContact : null,
            'bankName' => $request->bankName,
            'bankNumber' => $request->bankNumber,
            'bankAddress' => $request->bankAddress,
            'address' => $request->address,
            'contact' => $request->contact,
            'note' => $request->note,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        $shippingUnit->save();

        return back()->with('success', 'Tạo ĐVVC thành công');
    }

    public function edit(int $id)
    {

        $shippingUnit = ShippingUnit::find($id);
        $statusList = StatusShippingUnit::all();

        return view('admin.shipping_unit.edit', ['model' => $shippingUnit, 'statusList' => $statusList]);
    }


    public function update(EditSphippingUnitRequest $request)
    {

        try {
            $shippingUnit = ShippingUnit::findOrFail($request->id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return back()->with('fail', 'Lỗi không tìm thấy ID');
        }

        $shippingUnit->name = $request->name;
        $shippingUnit->phoneNumber = $request->phoneNumber;
        $shippingUnit->shortName = $request->shortName;
        $shippingUnit->taxId = $request->taxId;
        $shippingUnit->status_id =  intval($request->status_id);
        $shippingUnit->dateStopContact = $request->status_id == 2 ? $request->dateStopContact : null;
        $shippingUnit->bankName = $request->bankName;
        $shippingUnit->bankNumber = $request->bankNumber;
        $shippingUnit->bankAddress = $request->bankAddress;
        $shippingUnit->address = $request->address;
        $shippingUnit->contact = $request->contact;
        $shippingUnit->note = $request->note;
        $shippingUnit->updated_by = Auth::id();
        $shippingUnit->save();

        return back()->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {

        try {
            $shippingUnit = ShippingUnit::findOrFail($request->id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return response()->json([
                'fail' => 'Không tìm thấy dữ liệu tương ứng với ID!'
            ], 204);
        }

        $result = $shippingUnit->delete();
        // return back()->with('success', 'Xóa ĐVVC thành công');
        return response()->json([
            'success' => 'Xóa thành công ĐVVC mã ' . $request->id . '!'
        ], 200);
    }

    public function getAll(Request $request)
    {
        $targetColumn = ['created_at', 'updated_at'];
        $fromDate = $this->convertDate($request->from_date, 'begin');
        $toDate = $this->convertDate($request->to_date, 'end');
        $column = $request->column_date;
        $data = $this->getDataByDateBetween($column, $fromDate, $toDate);
        return DataTables::of($data)->make(true);
    }

    /**
     * Chuyển thời gian sang mysql
     *
     * @param string|null $value Chuỗi thời gian
     * @param string $option Chuỗi xác định thời gian 'begin': startOfDay, 'end':'endOfDay'
     *                 
     * @return string
     */
    private function convertDate(?string $value, string $option)
    {
        if (!Carbon::hasFormat($value, 'd/m/Y')) {
            return '';
        }
        if (empty($value) || is_null($value)) {
            return '';
        }
        if ($option == 'begin') {

            return Carbon::createFromFormat('d/m/Y', $value)->startOfDay();
        }
        if ($option == 'end') {

            return Carbon::createFromFormat('d/m/Y', $value)->endOfDay();
        }
    }

    private function getDataByDateBetween(?string $column, ?string $fromDate, ?string  $toDate)
    {

        if (empty($fromDate) && empty($toDate)) {
            $data = ShippingUnit::with('status', 'created_by', 'updated_by')->get();
        }
        if (!empty($fromDate) && !empty($toDate)) {
            $data = ShippingUnit::with('status', 'created_by', 'updated_by')
                ->whereBetween($column, [$fromDate, $toDate])
                ->get();
        }

        if (!empty($fromDate) && empty($toDate)) {
            $data = ShippingUnit::with('status', 'created_by', 'updated_by')
                ->whereBetween($column, [$fromDate, Carbon::today()->endOfDay()])
                ->get();
        }
        if (empty($fromDate) && !empty($toDate)) {
            $data = ShippingUnit::with('status', 'created_by', 'updated_by')
                ->whereBetween($column, [Carbon::today()->startOfDay(), $toDate])
                ->get();
        }
        return $data;
    }
}
