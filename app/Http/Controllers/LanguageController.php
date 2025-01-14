<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Save language data in session
     * 
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $language = $request->validate([
            'language' => 'in:en,pl',
        ])['language'];


        session(['language' => $language]);
        session()->save();

        return redirect()->back();
    }
}
