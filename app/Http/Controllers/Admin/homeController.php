<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\Locations as LC;
use App\Models\DetailTransactionGoods as DTG;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class homeController extends Controller
{

    private $parser = array();

    public function index()
    {
        $dataSession =\Session::get('auth');
        $dateNow = date('Y-m-d');
        $payday = "";
       if ($dataSession['name_position'] == 'Super Admin') {
           $payday =US::where('date_payday','=',$dateNow)->get()->toArray();
       }
       $data['user_count'] = US::count();
       $data['price_income_count'] = DTG::where('detail_transaction_goods.income','=',1)->sum('detail_transaction_goods.price');
       $data['price_outcome_count'] = DTG::where('detail_transaction_goods.income','=',0)->sum('detail_transaction_goods.price');
       $data['foods_income_count'] = DTG::where('detail_transaction_goods.income','=',0)->leftjoin('transaction_goods','detail_transaction_goods.id','=','transaction_goods.detail_transaction_id')->sum('transaction_goods.quantity');
       $data['foods_outcome_count'] = DTG::where('detail_transaction_goods.income','=',1)->leftjoin('transaction_goods','detail_transaction_goods.id','=','transaction_goods.detail_transaction_id')->sum('transaction_goods.quantity');
       $data['payday'] = $payday;
        return view("home",$data);
    }


}
