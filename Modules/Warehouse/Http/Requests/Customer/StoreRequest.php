<?php

namespace Modules\Warehouse\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Cargo\Entities\Client;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $email_validation = 'nullable|max:50|email|unique:users,email';
        $password_validation = 'sometimes|string|min:6|confirmed';
        if ($this->method() == 'PUT') {
            $user_id = Client::where('id',$this->route('client'))->pluck('user_id')->first();
            $email_validation .= (',' . $user_id . 'id');
            $password_validation = 'nullable|' . $password_validation;
        } else {
            $password_validation = 'nullable|' . $password_validation;
        }

        return [
            'company_name' => 'required|string|max:255',
            'contact_full_name' => 'required|string|max:255',
            'phones' => 'sometimes|max:255',
            'country_id' => 'sometimes|exists:countries,id',
            'address'=>'sometimes|max:255',
            'city'=>'sometimes|max:255',
            'state'=>'sometimes|max:255',
            'zip'=>'sometimes|max:255',
            'booking_emails'=>'sometimes|array',
            'booking_emails.*'=>'sometimes|email',
            'email'=>$email_validation,
            'password'=>$password_validation,
//            'password'=>'required|string|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
