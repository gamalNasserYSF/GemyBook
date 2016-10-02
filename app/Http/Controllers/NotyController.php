<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Requests;

class NotyController extends Controller
{    
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        Notification::create($request->all());
        return redirect('/');
    }

    public function update(Notification $noty, Request $request) {
        $noty->update($request->all());
        return $noty;
    }
    
}
