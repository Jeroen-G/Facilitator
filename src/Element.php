<?php

namespace JeroenG\Facilitator;

use Illuminate\Support\Facades\View;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\Arrayable;

class Element implements Arrayable, Htmlable
{
    /**
     * The type of element.
     *
     * @var string
     */
    protected $type;

    /**
     * Name of the element.
     *
     * @var string
     */
    protected $name;

    /**
     * Construct a new element.
     *
     * @param string $type
     * @param string $name
     */
    public function __construct(string $type, string $name)
    {
        $this->type = $type;
        $this->name = $name;
    }

    /**
     * Get the view, or null if it does not exist.
     *
     * @return string|null
     */
    public function view(): ?string
    {
        return (View::exists('facilitator::elements.'.$this->type))
                ? view('facilitator::elements.'.$this->type)->withName($this->name)
                : null;
    }

    /**
     * Get content as a string of HTML.
     *
     * @return string
     */
    public function toHtml(): ?string
    {
        return $this->view();
    }

    /**
     * Return the element as an array with its data.
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'type' => $this->type,
            'view' => $this->view(),
        ];
    }
}
