<?php

namespace JeroenG\Facilitator\Http\Controllers;

use Illuminate\Http\Request;
use JeroenG\Facilitator\Manager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use JeroenG\Facilitator\Http\Requests\FacilityRequest;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request, Manager $manager)
    {
        $this->manager = $manager;

        if ($request->facility) {
            $this->facility = $this->manager->findByName($request->facility);

            if ($this->facility->hasFormRequest()) {
                app()->bind(FacilityRequestInterface::class, $this->facility->getFormRequest());
            } else {
                app()->bind(FacilityRequestInterface::class, FacilityRequest::class);
            }
        }
    }
}
