<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.index');
    }

    public function toggleMaintence() {
        $isMaintence = \App::isDownForMaintenance();

        if ( $isMaintence ) {
            \Artisan::call('up');
            $status = 'ONLINE';
        } else {
            \Artisan::call('down');
            $status = 'OFFLINE';
        }

        session()->flash('message', 'Website: ' . $status );
        session()->flash('class', 'success');

        return redirect()->back();
    }
}
