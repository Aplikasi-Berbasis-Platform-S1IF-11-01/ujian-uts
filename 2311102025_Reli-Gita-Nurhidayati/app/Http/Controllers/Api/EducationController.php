<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::orderBy('order')->get();
        return response()->json($educations);
    }
}