<?php

namespace JeroenG\Facilitator;

use JeroenG\Facilitator\Contracts\Facility;

class Manager
{
    protected $namespace;

    /**
     * Find the facility by its name.
     *
     * @param string $facility
     *
     * @return \JeroenG\Facilitator\Contracts\Facility
     */
    public function findByName(string $name): Facility
    {
        return class_exists($name) ? $this->resolve($name) : $this->resolve($this->namespace.'\\'.ucfirst(strtolower($name)));
    }

    /**
     * Return an instance of the facility.
     *
     * @param string $facility
     *
     * @return \JeroenG\Facilitator\Contracts\Facility
     */
    public function resolve(string $class): Facility
    {
        return app($class);
    }

    /**
     * Set the value of namespace.
     *
     * @return self
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;

        return $this;
    }
}
