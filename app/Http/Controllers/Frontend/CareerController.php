<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Career;
use App\Resume;
use Storage;

class CareerController extends Controller
{
    /**
     * get Career
     */
    public function getCareer($id)
    {   
        return Career::where('id', $id)->first();
    }

    /**
     * newResume
     */
    public function newResume(Request $request, $id)
    {
        // return $request->file('resumeFile');
        // $files = $request->file('resumeFile');

    	$file = Input::file('resumeFile');
        $file->move(public_path('resume') , $file->getClientOriginalName());
        $data = [
            'address' => $request->address,
            'email' => $request->email,
            'fullName' => $request->fullName,
            'mobile' => $request->mobile,
            'postalCode' => $request->postalCode,
            'resumeFile' => '/resume/'.$file->getClientOriginalName(),
            'website' => $request->website,
            'belong' => $id,
        ];

        return Resume::create($data);
    }
}
