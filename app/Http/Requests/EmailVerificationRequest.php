<?php

namespace App\Http\Requests;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class EmailVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (!hash_equals(
            (string) $this->route('id'),
            (string) $this->user()->getKey()
        )) {
            return false;
        }

        if (!hash_equals(
            (string) $this->route('hash'),
            //   sha1($this->user()->getEmailForVerification()))) {
            sha1(session()->get('email'))
        )) {
            return false;
        }

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
            //
        ];
    }

    /**
     * Fulfill the email verification request.
     *
     * @return void
     */
    public function fulfill()
    {
        if (!$this->user()->hasVerifiedEmail()) {
            $this->user()->markEmailAsVerified();

            event(new Verified($this->user()));
        }
    }

    public function fulfillUpdateEmail()
    {
        $user = User::find($this->user()->id);
        $user->email = (session()->get('email'));
        $user->update();
        session()->flush();
        // $this->user()->markEmailAsVerified();

    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        return $validator;
    }
}
