<?php

namespace JeroenG\Facilitator\Tests\Fixtures\Requests;

use Illuminate\Foundation\Http\FormRequest;
use JeroenG\Facilitator\Http\Controllers\FacilityRequestInterface;

class FacilityRequest extends FormRequest implements FacilityRequestInterface
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
            'title' => 'required',
            'content' => 'required',
        ];
    }
}
