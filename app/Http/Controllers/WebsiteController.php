<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Website;

class WebsiteController extends Controller
{
    public function index()
    {
        $Websites = Website::latest()->paginate(10);
        return view('admin.website.index',compact('Websites'));
    }

    public function store()
    {
        $this->authorize('AdminAuthorize');
        Request()->validate([
            'web_name' => 'required',
            'url' => 'required|url|unique:websites'
        ]);
        Website::create([
            'web_name' => request()->web_name,
            'url' => request()->url,
        ]);
        return redirect('/C19News');
    }

    public function delete(Website $Website)
    {
        $this->authorize('AdminAuthorize');
        $Website->delete();
        return redirect('/C19News');
    }
}
