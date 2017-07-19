<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePollForm extends FormRequest
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
     * Override parent getValidatorInstance() to insert
     * sanitize method before rules are called.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function getValidatorInstance() {
        $this->sanitize();
        return parent::getValidatorInstance();
    }

    protected function sanitize() {
        $input = $this->all();

        // get rid of any empty elements from 'choices' array
        if (array_key_exists('choices', $input)) {
            foreach ($input['choices'] as $key => $choice) {
                if (trim($choice)) {
                    $input['choices'][$key] = $choice;
                } else {
                    unset($input['choices'][$key]);
                }
            }
            $this->replace($input);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:' . (140 -
                    strlen('|Polls by Bascoy') -
                    strlen('http://www.elybascoy.com/polls/') - 6),
            'choices' => 'required'
        ];
    }
}
