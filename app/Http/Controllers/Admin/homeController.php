<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class homeController extends Controller
{

    private $parser = array();

    public function index()
    {
        return view("home");
    }


}
