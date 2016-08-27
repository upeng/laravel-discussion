<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $test = array(
            array('name' => 'Jim', 'score' => 80),
            array('name' => 'Joy', 'score' => 70),
            array('name' => 'Tom', 'score' => 30),
            array('name' => 'Liy', 'score' => 50),
            array('name' => 'Lee', 'score' => 20),
            array('name' => 'Pau', 'score' => 10),
        );
        var_dump(collect($test)->chunk(2)->toJson());
        var_dump(collect($test)->avg('score'));

        $numbers = [1,2,3];
        var_dump(collect($numbers)->merge([2,4,5]));
        //return view('home');
    }
}
