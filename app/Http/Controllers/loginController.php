<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class loginController extends Controller
{

    private $parser = array();

    public function login()
    {
        
     return view('login');
    }
   public function loginCheck()
    {
        $users = US::getAll();
        $data = json_decode(json_encode($users), true);

        $alldataAuth = !empty($data[0]) ? $data[0] :'' ;
        if (empty($alldataAuth)) {
            \Session::flash('messageError', 'Login Gagal');
            return redirect('/login');
        }
        unset($alldataAuth['password']);
        \Session::put('auth',$alldataAuth);
        return redirect('/admin/dashboard');
    }
   public function logout()
    {
        \Session::forget('auth');
        return redirect('/login');

    }


}
