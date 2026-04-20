
<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    private $watermark = "2311102001_NofitaFitriyani";

    public function index()
    {
        return response()->json(Profile::first());
    }

    public function update(Request $request)
    {
        $profile = Profile::first();
        if(!$profile){
            $profile = Profile::create($request->all());
        } else {
            $profile->update($request->all());
        }
        return response()->json(['success'=>true]);
    }
}
