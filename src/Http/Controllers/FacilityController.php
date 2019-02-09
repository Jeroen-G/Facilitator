<?php

namespace JeroenG\Facilitator\Http\Controllers;

class FacilityController extends Controller
{
    public function index()
    {
    }

    public function show(string $facility, $id)
    {
    }

    public function create(string $facility)
    {
        return view('test')->withData(['facility' => $facility, 'form' => $this->facility->buildForm()]);
    }

    public function store(FacilityRequestInterface $request, string $facility)
    {
        $this->facility->model()->create($request->all());

        return 'success';
    }

    public function edit(string $facility)
    {
        return view('test')->withData(['form' => $this->facility->buildForm()]);
    }

    public function update(FacilityRequestInterface $request, string $facility)
    {
        $this->facility->model()->update($request->all());

        return 'success';
    }
}
