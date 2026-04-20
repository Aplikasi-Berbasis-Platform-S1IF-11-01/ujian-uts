
<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json(Skill::all());
    }

    public function store(Request $request)
    {
        Skill::create($request->all());
        return response()->json(['success'=>true]);
    }

    public function delete($id)
    {
        Skill::find($id)?->delete();
        return response()->json(['success'=>true]);
    }
}
