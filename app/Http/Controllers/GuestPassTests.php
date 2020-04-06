<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tests\Browser\GuestPassTest;

class GuestPassTests extends Controller
{
    function __invoke(){
        $test = new GuestPassTest();
        $test->setup();
        $test->testVerifyData();

        return response()->json([
            'success' => 'true',
        ]);
    }
}
