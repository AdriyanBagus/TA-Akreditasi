<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Settings;

class CheckFormStatus
{
    public function handle(Request $request, Closure $next, $formName)
    {
        // Cek form di table settings
        $form = Settings::where('form_name', $formName)->first();

        if (!$form) {
            return redirect()->route('form.off')->with('error', 'Pengaturan form tidak ditemukan.');
        }

        if ($form->status == 0) {
            return redirect()->route('form.off')->with('error', 'Form ini sedang tidak tersedia.');
        }

        // Cek apakah form ini diaktifkan untuk user tertentu
        $userId = auth()->id();
        $isEnabled = DB::table('form_user_settings')
            ->where('form_id', $form->id)
            ->where('user_id', $userId)
            ->value('is_enabled');

        if ($isEnabled === null || !$isEnabled) {
            return redirect()->route('form.off')->with('error', 'Form ini sedang tidak tersedia.');
        }

        return $next($request);
    }
}

