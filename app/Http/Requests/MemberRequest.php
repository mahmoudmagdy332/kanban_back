<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'title'=> 'required|min:10',
            'age'=>'required|numeric|between:18,60',
            'email'=> 'required|email|unique:members,email,' . $this->id,
            'mobile' => 'required |regex:/^\+?[1-9]\d{1,14}$/',
            'status' =>'nullable|in:Unclaimed,FirstContact,PreparingWorkOffer,SendTherapist',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => 'failed',
                'message' => $validator->errors()->first(),
            ], 422)
        );
    }
}
