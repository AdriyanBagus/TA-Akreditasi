<?php

namespace App\Http\Controllers;

use App\Models\KerjasamaPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagramController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            $diagram_view = KerjasamaPendidikan::selectRaw('tingkat, COUNT(*) as total')
                ->where('user_id', Auth::id())
                ->groupBy('tingkat')
                ->pluck('total', 'tingkat');
        }
        return view('pages.diagram_view', compact('diagram_view'));
    }

}