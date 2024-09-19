<?php

namespace App\Api\V1\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
{
    protected $validate = [];
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
        if($this->isMethod('GET')) {

            $this->validate = $this->methodGet();

        }elseif($this->isMethod('POST')) {

            $this->validate = $this->methodPost();

        }elseif($this->isMethod('PUT')) {

            $this->validate = $this->methodPut();

        }elseif($this->isMethod('PATCH')) {

            $this->validate = $this->methodPatch();

        }elseif($this->isMethod('DELETE')) {

            $this->validate = $this->methodDelete();

        }elseif($this->isMethod('OPTIONS')) {

            $this->validate = $this->methodOptions();
            
        }

        return $this->validate;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodGet()
    {
        return [

        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPut()
    {
        return [
            
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPatch()
    {
        return [
            
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodDelete()
    {
        return [
            
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodOptions()
    {
        return [
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        
        // $errors = collect($errors)->flatten(1);
 
        // $errors = $errors->implode('; ');
        
        throw new HttpResponseException(
            response()->json([
                'status' => 400,
                'message' => __('Vui lòng kiểm tra lại các trường field'),
                'message_validate' => $errors
            ], 400)
        );
    }
}
