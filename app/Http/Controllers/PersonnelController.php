<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Personnel;

class PersonnelController extends Controller
{
    public function savepersonnel(Request $request)
    {
        $request->validate([
            'adminofficer' => 'required',
            'engineer' => 'required',
            'vicechancellor' => 'required',
            'chancellor' => 'required'
        ]);

        Personnel::updateOrCreate(['id'=>$request->id], $request->all());

        return redirect()->back()->with('success', 'Personnel successfully saved');
    }
}
