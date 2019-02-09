<?php

namespace JeroenG\Facilitator\Http\Requests;

use JeroenG\Facilitator\Manager;
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
     * If the facility has custom rules set, use those. Otherwise all is acceptable.
     *
     * @return array
     */
    public function rules()
    {
        $facility = $this->container->make(Manager::class)->findByName($this->facility);

        return $facility->rules ?? [];
    }
}
