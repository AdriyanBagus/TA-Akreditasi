<?php

namespace App\Http\Controllers;

use App\Models\King;
use Illuminate\Http\Request;

class KingController extends Controller
{
    public function index()
    {
        $items = King::all();
        return view('kings.index', compact('items'));
    }

    public function create()
    {
        return view('kings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'adi' => 'required',
            'sucipto' => 'required'
        ]);

        King::create($validated);

        return redirect()->route('kings.index')->with('success', 'King created!');
    }

    public function edit(King $item)
    {
        return view('kings.edit', compact('item'));
    }

    public function update(Request $request, King $item)
    {
        $validated = $request->validate([
            'adi' => 'required',
            'sucipto' => 'required'
        ]);

        $item->update($validated);

        return redirect()->route('kings.index')->with('success', 'King updated!');
    }

    public function destroy(King $item)
    {
        $item->delete();
        return redirect()->route('kings.index')->with('success', 'King deleted!');
    }
}