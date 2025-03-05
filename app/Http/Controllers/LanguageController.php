<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch($lang)
    {
        // Set the desired language in session (or a cookie)
        session(['locale' => $lang]);
        app()->setLocale($lang);
        // Redirect back to the previous page or a default route
        return redirect()->back();
    }
}
