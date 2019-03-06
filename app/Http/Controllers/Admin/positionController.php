<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Users as US;
use App\Models\Positions as PS;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Response;
class positionController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['positions'] = PS::get()->toArray();
    
        return view('admin/user/position',$data);
    }
    public function create() {
        $rules=[
            'name'=>'required',
           
             ];
        $messages=[
            'name.required'=>config('constants.ERROR_JML_WAJIB'),
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
            $position =new PS;
            $position->name =$data['name'];
            $position->save();

            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
           $position =PS::find($data['id']);
           $position->name = $data['name'];
           $position->update();
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
        $edit = PS::where("positions.id",$id)->get();
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
        try {
            $position = PS::find($id);
            $position->delete();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'this data is used in other tables');
            return \Redirect::to(route('position.index'));
        }

        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('position.index'));
    }
}