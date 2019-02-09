<?php

namespace JeroenG\Facilitator\Concerns;

use JeroenG\Facilitator\Manager;
use JeroenG\Facilitator\Contracts\Facility;

trait HasFacility
{
    /**
     * Get the facility for the implementing model.
     *
     * @param string $facility
     *
     * @return \JeroenG\Facilitator\Contracts\Facility
     */
    public function getFacility(): Facility
    {
        return app(Manager::class)->findByName($this->facilityClass ?? (new \ReflectionClass($this))->getShortName());
    }
}
