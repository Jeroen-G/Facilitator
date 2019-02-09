<?php

namespace JeroenG\Facilitator\Contracts;

use Illuminate\Support\Collection;
use JeroenG\Facilitator\Element;
use Illuminate\Database\Eloquent\Model;

interface Facility
{
    /**
     * Get an instance of the associated model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model(): Model;

    /**
     * Get the fillable fields of the associated model.
     *
     * @return \Illuminate\Support\Collection
     */
    public function fillables(): Collection;

    /**
     * Define custom views for the fields.
     *
     * @return \Illuminate\Support\Collection
     */
    public function fields(): Collection;

    /**
     * Build the HTML form elements.
     *
     * @return \Illuminate\Support\Collection
     */
    public function buildForm(): Collection;

    /**
     * Determine whether there already is a specific implementation for the given field.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasFieldFor(string $name): bool;

    /**
     * Give the HTML output for the given field.
     *
     * @param string $type
     * @param string $name
     *
     * @return \JeroenG\Facilitator\Element
     */
    public function makeField(string $type, string $name): Element;

    /**
     * Get the form request assigned to this model and class.
     */
    public function getFormRequest(): string;

    /**
     * Determine if the facility has set a form request class.
     *
     * @return bool
     */
    public function hasFormRequest(): bool;
}
