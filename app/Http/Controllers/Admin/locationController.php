<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Locations as LC;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Response;
class locationController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['locations'] = LC::where('status_id','!=',3)->get()->toArray();
        return view('admin/location/location',$data);
    }
    public function locationGoods() {
        $data['locations'] = LC::where('status_id','!=',3)->get()->toArray();
        return view('admin/location/location_goods',$data);
    }
    public function create() {
        $rules=[
            'name'=>'required',
            'city'=>'required',
            'country'=>'required',   
             ];
        $messages=[
            'name.required'=>config('constants.ERROR_JML_WAJIB'),
            'city.required'=>config('constants.ERROR_JML_WAJIB'),
            'country.required'=>config('constants.ERROR_JML_WAJIB'),   
        ];
        $validator=Validator::make(Input::all(), $rules, $messages);
        if ($validator->passes()) {
            //get Data session for creator
            if (!empty(Input::get('id'))) {
                //this is update employe
            $return =$this->update(Input::all());
            return $return;
            }else {
            $return = $this->save(Input::all());
            return $return;
            }
        $return['status'] = false;
        $return['messages'] =$validator;
        $return['data'] =[];
        return $return;
    }
}
    public function save($data) {
        $dataSession =\Session::get('auth');
            $location =new LC;
            $location->name =$data['name'];
            $location->city =$data['city'];
            $location->description =$data['description'];
            $location->country =$data['country'];
            $location->status_id = 1;
            $location->created_at = date("Y-m-d H:i:s");
            $location->updated_at = date("Y-m-d H:i:s");
            $location->created_by = $dataSession['id'];
            $location->save();

            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
        $dataSession =\Session::get('auth');
           $location =LC::find($data['id']);
           $location->name =$data['name'];
           $location->city =$data['city'];
           $location->description =$data['description'];
           $location->country =$data['country'];
           $location->status_id = 1;
           $location->updated_at = date("Y-m-d H:i:s");
           $location->created_by = $dataSession['id'];
           $location->update();
           //return
           $return['status'] = true;
           $return['messages'] ='Berhasil';
           $return['data'] =[];
           
           return $return;
    }
    public function edit() {
        //get id karyawan
        $id =Input::get('id');
        //get karyawan by id
        $edit = LC::where("locations.id",$id)->get();
        $data = json_decode(json_encode($edit), true);
        if ($edit) {
            $data[0]['submit'] = "Update";
            $json['status'] = true;
            $json['messages'] = 'Success';
            $json['data'] = $data[0];
        }else{
            $json['status'] = false;
            $json['messages'] = 'Failed';
            $json['data'] = [];
        }
         //send view with data
         return Response::json($json);
    }
    public function delete($id)
    {
    
            $location = LC::find($id);
            $location->status_id = 3;
            $location->update();
     
        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('location.index'));
    }
    public function getTransaction()
    {
    $search = Input::all();
    $income = false;
    $outcome = false;
    $i = 0;
    $o = 0;
    foreach ($search['status'] as $key => $value) {
       if ($value == 1) {
           $income = true;
       }
       if ($value == 2){
           $outcome = true;
       }
    }
    if ($income == true) {
        $dataDetail = LC::GetTransaction($search,true);
        foreach ($dataDetail as $key => $value) {
            $getFoodTransactionDetail = LC::GetFoodTransactionDetail($value->detail_id);
            $value->food_detail= (object)[];
            $value->food_detail = $getFoodTransactionDetail;
        }
        $data_income = json_decode(json_encode($dataDetail), true);
        if (!empty($data_income)) {
            $list['data_outcome'] = $data_income[0];
            $i = $data_income[0]['price'];
        }
    }
    if ($outcome == true) {
        $dataDetailOutcome = LC::GetTransaction($search, false);
        foreach ($dataDetailOutcome as $key => $value) {
            $getFoodTransactionDetail = LC::GetFoodTransactionDetail($value->detail_id);
            $value->food_detail= (object)[];
            $value->food_detail = $getFoodTransactionDetail;
        }
        $data_outcome = json_decode(json_encode($dataDetailOutcome), true);
        if (!empty($data_outcome)) {
            $list['data'] = $data_outcome[0];
            $o = $data_outcome[0]['price'];
        }
    } 
        if (!empty($data_income) || !empty($data_outcome)) { 
            $list['calculate'] = $i - $o;
            if ($list['calculate'] < 0) {
                $list['minus_calculate'] = 1;
            }else {
                $list['minus_calculate'] = 2;
            }
            
            $result = view('admin/location/show_transaction',$list)->render();
            $json['status'] = true;
            $json['messages'] = '';
            $json['data'] = $result;
           return Response::json($json);
        }
        $json['status'] = false;
        $json['messages'] = 'Data tidak ditemukan';
        $json['data'] = [];
        return Response::json($json);
    }
    
}