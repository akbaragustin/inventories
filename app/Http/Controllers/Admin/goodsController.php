<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Foods as GS;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Response;
class goodsController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['goods'] = GS::all()->toArray();
        return view('admin/goods/goods',$data);
    }
    public function create() {
        $rules=[
            'name'=>'required',
            'unit'=>'required'
             ];
        $messages=[
            'name.required'=>config('constants.ERROR_JML_WAJIB'),
            'unit.required'=>config('constants.ERROR_JML_WAJIB')  
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
            $goods =new GS;
            $goods->name =$data['name'];
            $goods->unit =$data['unit'];
            $goods->created_at = date("Y-m-d H:i:s");
            $goods->updated_at = date("Y-m-d H:i:s");
            $goods->created_by = $dataSession['id'];
            $goods->save();

            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
        $dataSession =\Session::get('auth');
           $goods =GS::find($data['id']);
           $goods->name =$data['name'];
           $goods->unit =$data['name'];
           $goods->updated_at = date("Y-m-d H:i:s");
           $goods->created_by = $dataSession['id'];
           $goods->update();
           //return
           $return['status'] = true;
           $return['messages'] ='Berhasil';
           $return['data'] =[];
           
           return $return;
    }
    public function edit() {
        //get id Goods
        $id =Input::get('id');
        //get Goods by id
        $edit = GS::where("id",$id)->get();
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
            $goods = GS::find($id);
            $goods->delete();
     
        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('goods.index'));
    }
}