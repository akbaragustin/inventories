<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Assets as AST;
use App\Models\Locations as LC;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Response;
class assetController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['locations'] = LC::where('status_id','!=',3)->get()->toArray();
        $assets = AST::GetAll();
        $data['assets'] = json_decode(json_encode($assets), true);
        // echo "<pre>";
        // print_r($data['assets']);die;
        return view('admin/asset/asset_taker',$data);
    }
    public function create() {
            //get Data session for creator
            if (!empty(Input::get('id'))) {
                //this is update employe
            $return =$this->update(Input::all());
            return $return;
            }else {
            $return = $this->save(Input::all());
            return $return;
            }

}
    public function save($data) {
        if (empty(Input::file('picture'))) {
            $return['status'] = false;
            $return['messages'] ='Silahkan isi nota';
            $return['data'] =[];
            return $return;
        }
         $dataSession = \Session::get('auth');
            $picture =$this->uploadfile('picture');
            $asset =new AST;
            $asset->name =$data['name'];
            $asset->location_id =$data['location_id'];
            $asset->shift =$data['shift'];
            $asset->created_at =date('Y-m-d H:i:s');
            $asset->updated_at=date('Y-m-d H:i:s');
            $asset->quantity= $data['quantity'];
            $asset->status_id= 1;
            $asset->price= str_replace('.','',$data['price']);
            $asset->description= $data['description'];
            $asset->date_transaction= date('Y-m-d',strtotime($data['date_transaction']));
            $asset->created_by=$dataSession['id'];
            $asset->file_path = $picture;  
            $asset->save();
           
            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
           $dataSession = \Session::get('auth');
           //get data id_category where brand and category 
           $asset =AST::find($data['id']);
           $asset->name =$data['name'];
           $asset->location_id =$data['location_id'];
           $asset->shift =$data['shift'];
           $asset->quantity =$data['quantity'];
           $asset->price =$data['price'];
           $asset->description =$data['description'];
           $asset->date_transaction= date('Y-m-d',strtotime($data['date_transaction']));
           $asset->created_by=$dataSession['id'];
           $asset->updated_at=date('Y-m-d H:i:s');
           if (!empty(Input::file('picture'))) {
              $asset->file_path =$this->uploadfile('picture');
               if (!empty($data['picture_repeat'])) {
               $deleteImage = getcwd().'/uploads/picture/'.$data['picture_repeat'];
                   if (file_exists($deleteImage)) {
                       !unlink($deleteImage);
                   }
               }
           }
           $asset->update();
           //return
           $return['status'] = true;
           $return['messages'] ='Berhasil';
           $return['data'] =[];
           
           return $return;
    }
    private function uploadfile($fn)
    {
        if (!empty(Input::file($fn))) {
            $file = Input::file($fn)->isValid();
            $destinationPath = public_path().'/uploads/'.$fn;
            $extension =Input::file($fn)->getClientOriginalExtension();
            $fileName = rand(11111, 99999).'.'.$extension;
            Input::file($fn)->move($destinationPath, $fileName);
            return $fileName;
        }
    }
    public function edit() {
        //get id karyawan
        $id =Input::get('id');
        //get karyawan by id
        $edit = AST::getByID($id);
        $data = json_decode(json_encode($edit), true);
        $data[0]['date_transaction'] = date("m/d/Y",strtotime($data[0]['date_transaction']));
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
            $asset = AST::find($id);
            $asset->status_id = 3;
            $asset->update();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'this data is used in other tables');
            return \Redirect::to(route('asset.index'));
        }

        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('asset.index'));
    }
    public function showAjax(){
        $id = Input::get('id_asset');
        $edit = AST::getByID($id);
        $data = json_decode(json_encode($edit), true);
        $list['data'] =$data[0];
        
       return view('admin/asset/show',$list);
   }
  public function printPrecord(){
         $id = Input::get('id');
        $edit = AST::getByID($id);
        $data = json_decode(json_encode($edit), true);
        $list['data'] =$data[0];
        
   return view('admin/asset/show_print',$list);
   }

}