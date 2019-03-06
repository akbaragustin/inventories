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
}