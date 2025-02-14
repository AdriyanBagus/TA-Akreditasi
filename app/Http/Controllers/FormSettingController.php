<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;

class FormSettingController extends Controller
{
    public function index()
    {
        $forms = Settings::all();
        return view('admin.form_settings', compact('forms'));
    }

    public function update(Request $request, $id)
    {
        $form = Settings::findOrFail($id);
        $form->status = $request->status;
        $form->save();

        return redirect()->back()->with('success', 'Status form berhasil diperbarui!');
    }
}
