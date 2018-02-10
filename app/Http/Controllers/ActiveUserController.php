<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActiveUser;

class ActiveUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ip' => 'required|min:7|max:15',
            'country_code' => 'required|max:2',
            'city' => 'required|min:2',
        ]);

        $data = [
            'ip' => request('ip'),
            'country' => request('country_code'),
            'city' => request('city'),
            'timestamp' => date('Y-m-d h:i', time())
        ];

        $now = date('Y-m-d h:i', time());
        $user = ActiveUser::updateOrCreate([
            'ip' => request('ip')
        ], $data);


        $inactive = ActiveUser::where('timestamp', '<', $now)->delete();

        return json_encode($user);
    }

    public function show()
    {
        $counter = new ActiveUser;
        $counter = $counter->count();

        $data = [
            'timestamp' => date('Y-m-d h:i:s'),
            'active_users' => $counter
        ];

        return json_encode($data);
    }
}
