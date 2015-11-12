<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

/**
 * Form name properties.
 *
 * @property mixed Gsm
 * @property mixed Email
 * @property mixed Groep
 * @property mixed EindDatum
 * @property mixed StartDatum
 */
class RentalValidator extends Request
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
            // 'Gsm'        => 'required',
            'Email'      => 'required',
            'Groep'      => 'required',
            'EindDatum'  => 'required',
            'StartDatum' => 'required',
        ];
    }
}
