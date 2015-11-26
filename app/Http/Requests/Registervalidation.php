<?php

namespace App\Http\Requests;

/**
 * @property mixed name      The name off the user.
 * @property mixed email     The email address off the user.
 * @property mixed password  the password for the user.
 */
class Registervalidation extends Request
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
        // No validation rules need to be set.
        // Because they are coming for the language file.
        // resources/<country iso code>/validation.php

        return [
            'name'     => 'required',
            'email'    => 'required',
        ];
    }
}
