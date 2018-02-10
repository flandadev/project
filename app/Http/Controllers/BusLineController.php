<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\BusLine;

class BusLineController extends Controller
{
    public function index() {
        $lines = BusLine::all()->toArray();
        return view('admin.bus.index', compact('lines'));
    }

    public function create() {
        return view('admin.bus.create');
    }

    public function store(Request $request) {
        $request->validate([
           'origin' => 'required',
           'price' => 'required'
        ]);

        if ( BusLine::where('origin', $request->origin)->get()->count() ) {
            return redirect()->back()->withInput();
        }

        $bus = new BusLine;
        $bus->price = ucfirst($request->price);
        $bus->origin = $request->origin;
        $bus->saveOrFail();

        return redirect()->to('/admin/bus');
    }

    public function edit(BusLine $bus) {
        return view('admin.bus.edit', compact('bus'));
    }

    public function update(BusLine $bus, Request $request) {
        $request->validate([
            'origin' => 'required',
            'price' => 'required'
        ]);

        $bus->price = $request->price;
        $bus->origin = $request->origin;

        $bus->saveOrFail();

        return redirect()->to('/admin/bus');
    }

    public function destroy(BusLine $bus) {
        $bus->delete();
        return redirect()->back();
    }
}


// RESOURCE SAMPLE WITH EVENT
# get           admin/bus                  -> index
# post          admin/bus                  -> store
# get           admin/bus/create           -> create
# get           admin/bus/{id}             -> show
# get           admin/bus/{id}/edit        -> edit
# put/patch     admin/bus/{id}             -> update
# delete        admin/bus/{id}             -> destroy