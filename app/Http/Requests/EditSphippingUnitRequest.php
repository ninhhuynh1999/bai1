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
        return Auth::check();
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
}
