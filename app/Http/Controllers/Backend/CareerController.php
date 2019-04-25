<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Career;

class CareerController extends Controller
{
    /**
     * addCareer
     */
    public function addCareer(Request $request)
    {
        return Career::create($request->all());
    }

    /**
     * editCareer
     */
    public function editCareer(Request $request, $id)
    {
        return Career::where('id', $id)->update($request->all());
    }

    /**
     * getCareers
     */
    public function getCareers()
    {
        return Career::paginate(12);
    }

    /**
     * getCareer
     */
    public function getCareer($id)
    {
        return Career::where('id', $id)->first();
    }

    /**
     * deleteCareer
     */
    public function deleteCareer($id)
    {
        return Career::where('id', $id)->delete();
    }
}
