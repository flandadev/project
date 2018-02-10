<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function generateTickets($quantity = 1)
    {
        $tickets = [];

        for ($i=0; $i < $quantity; $i++) {
            $tickets[] = $this->rand_string();
        }

        if ($quantity === 1) {
            return $tickets[0];
        }

        return $tickets;
    }

    protected function rand_string($len = 7)
    {
        $key = "abcdefghijklmnopqrstuvwxyz0123456789";
        $rand = "";

        for ($i=0; $i < $len; $i++) {
            $rand .= $key[rand(0, strlen($key) - 1)];
        }

        return $rand;
    }
}
