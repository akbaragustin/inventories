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
class userController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['positions'] = PS::get()->toArray();
        $users = US::getAll();
        $data['users'] = json_decode(json_encode($users), true);
       
        return view('admin/user/user',$data);
    }
    public function create() {
        $rules=[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'position_id'=> 'required'
             ];
        $messages=[
            'name.required'=>config('constants.ERROR_JML_WAJIB'),
            'email.required'=>config('constants.ERROR_JML_WAJIB'),
            'password.required'=>config('constants.ERROR_JML_WAJIB'),
            'position_id.required'=>config('constants.ERROR_JML_WAJIB'),
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
        $checkPassword = US::where('password', md5($data['password']))->get()->toArray();
        if (empty($checkPassword)) {
            $picture =$this->uploadfile('picture');
            $users =new US;
            $users->name =$data['name'];
            $users->position_id =$data['position_id'];
            $users->password =md5($data['password']);
            $users->email =$data['email'];
            $users->created_at =date('Y-m-d H:i:s');
            $users->updated_at=date('Y-m-d H:i:s');
            $users->phone_number= $data['phone_number'];
            $users->file_path = $picture;  
            $users->save();
           
            $return['status'] = true;
            $return['messages'] ='Berhasil';
            $return['data'] =[];
            return $return;

        }
            $validator = 'password yang anda gunakan telah tersedia. gunakan password lain!';
            $return['status'] = true;
            $return['messages'] =$validator;
            $return['data'] =[];
            return $return;
    }
   
    
    public function update($data) {
           
           //get data id_category where brand and category 
           $user =US::find($data['id']);
           $user->name =$data['name'];
           $user->position_id =$data['position_id'];
           if ($data['password'] == $data['old_password']) {
            $user->password =$data['password'];
           }else{
            $user->password =md5($data['password']);
           }
           $user->email =$data['email'];
           $user->updated_at=date('Y-m-d H:i:s');
           $user->phone_number= $data['phone_number'];
           if (!empty(Input::file('picture'))) {
              $user->file_path =$this->uploadfile('picture');
               if (!empty($data['picture_repeat'])) {
               $deleteImage = getcwd().'/uploads/picture/'.$data['picture_repeat'];
                   if (file_exists($deleteImage)) {
                       !unlink($deleteImage);
                   }
               }
           }
           $user->update();
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
        $edit = US::getByID($id);
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
            $user = US::find($id);
            $user->delete();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'this data is used in other tables');
            return \Redirect::to(route('user.index'));
        }

        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('user.index'));
    }
}