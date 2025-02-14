<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Settings;

class CheckFormStatus
{
    public function handle(Request $request, Closure $next, $formName)
    {
        $formStatus = Settings::where('form_name', $formName)->first();

        if (!$formStatus) {
            return redirect()->route('form.off')->with('error', 'Pengaturan form tidak ditemukan.');
        }

        if ($formStatus->status == 0) {
            return redirect()->route('form.off')->with('error', 'Form ini sedang tidak tersedia.');
        }

        return $next($request);
    }
}
