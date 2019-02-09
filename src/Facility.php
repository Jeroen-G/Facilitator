<?php

namespace JeroenG\Facilitator;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use JeroenG\Facilitator\Contracts\Facility as FacilityContract;
use JeroenG\Facilitator\Http\Requests\FacilityRequest;

abstract class Facility implements FacilityContract
{
    /**
     * The namespaced class of the model associated with this facility.
     *
     * @var string
     */
    protected $model;

    /**
     * Holds the fields necessary to build the form.
     *
     * @var array
     */
    protected $fields;

    /**
     * Get an instance of the associated model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model(): Model
    {
        // TODO: check and possibly throw exception
        return app($this->model);
    }

    /**
     * Get the fillable fields of the associated model.
     *
     * @return \Illuminate\Support\Collection
     */
    public function fillables(): Collection
    {
        return collect($this->fillables ?? $this->model()->getFillable());
    }

    /**
     * Define custom views for the fields.
     *
     * @return \Illuminate\Support\Collection
     */
    public function fields(): Collection
    {
        return collect(($this->fields ?? []));
    }

    /**
     * Build the HTML form elements.
     *
     * @return \Illuminate\Support\Collection
     */
    public function buildForm(): Collection
    {
        return $this->fillables()->map(function ($attribute) {
            if ($this->hasFieldFor($attribute)) {
                return $this->makeField($this->fields()->get($attribute), $attribute);
            }

            return $this->makeField('text', $attribute);
        })->push($this->makeField('save', 'Save'));
    }

    /**
     * Determine whether there already is a specific implementation for the given field.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasFieldFor(string $name): bool
    {
        return $this->fields()->has($name);
    }

    /**
     * Give the HTML output for the given field.
     *
     * @param string $type
     * @param string $name
     *
     * @return \JeroenG\Facilitator\Element
     */
    public function makeField(string $type, string $name): Element
    {
        return new Element($type, $name);
    }

    /**
     * Determine if the facility has set a form request class.
     *
     * @return bool
     */
    public function hasFormRequest(): bool
    {
        return isset($this->formRequest);
    }

    /**
     * Get the form request assigned to this model and class.
     */
    public function getFormRequest(): string
    {
        return $this->formRequest ?? FacilityRequest::class;
    }
}
