<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateShippingUnitRequest;
use App\Http\Requests\EditSphippingUnitRequest;
use App\ShippingUnit;
use App\StatusShippingUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingUnitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('admin.shipping-unit.index');
    }

    public function create()
    {

        $statusList = StatusShippingUnit::all();

        return view('admin.shipping-unit.create', ['statusList' => $statusList]);
    }

    public function store(CreateShippingUnitRequest $request)
    {

        $shippingUnit =  ShippingUnit::create([
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'shortName' => $request->shortName,
            'taxId' => $request->taxId,
            'dateStopContact' => $request->taxId === 2 ? $request->dateStopContact : null,
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
        return back();
    }

    public function edit(int $id)
    {

        $shippingUnit = ShippingUnit::find($id);
        $statusList = StatusShippingUnit::all();

        return view('admin.shipping-unit.edit', ['model' => $shippingUnit,'statusList'=> $statusList]);
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
        $shippingUnit->dateStopContact = $request->dateStopContact;
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
        $id = $request->id;

        try {
            $shippingUnit = ShippingUnit::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $th) {
            return back()->with('fail', 'Not Found Your Unit');
        }

        if (!$shippingUnit->created_by === Auth::id()) {
            return back()->with('fail', 'Delete fail (Unauthorized)');
        }

        $result = $shippingUnit->delete();
        return back()->with('success', 'Deleted Successfully');
    }
}
