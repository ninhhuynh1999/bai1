<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditSphippingUnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>[
                'required',
                 'unique:shipping_units,name,'.$this->id,
            ],
            'shortName'=>[
                'required',
                'unique:shipping_units,shortName,'.$this->id,
            ],
            'phoneNumber'=> array(
                'digits:10,numeric','nullable'
            ),
            'taxId'=>array(
                'digits:10,numeric','nullable'
            ),
            'bankNumber'=>array(
                'digits_between:9,14,numeric','nullable'
            ),
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên không được để trống',
            'name.unique'=>'Tên đã được sử dụng',
            'shortName.required'=>'Tên viết tắt không được để trống',
            'shortName.unique'=>'Tên viết tắt đã được sử dụng',
            'phoneNumber.digits'=>'SĐT phải là 10 số',
            'taxId.digits'=>'Mã số thuế phải 10 số',
            'bankNumber.digits_between'=>'Số tài khoản phải từ 9-14 số',
        ];
    }
}
