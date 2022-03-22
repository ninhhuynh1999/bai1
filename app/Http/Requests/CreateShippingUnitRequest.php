<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateShippingUnitRequest extends FormRequest
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
            'name'=>'required|unique:shipping_units,name',
            'shortName'=>'required|unique:shipping_units,shortName',
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
}
