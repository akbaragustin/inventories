<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Assets as AST;
use App\Models\Locations as LC;
use App\Models\Foods as GS;
use App\Models\DetailTransactionGoods as DTG;
use App\Models\TransactionGoods as TG;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
class reportController extends Controller
{

    private $parser = array();

    public function index()
    {
        $data['goods'] = GS::all()->toArray();
        $data['locations'] = LC::where('status_id','!=',3)->get()->toArray();
        
        $detailTransaction = DTG::GetAll();
        $data['detail_transaction_goods'] = json_decode(json_encode($detailTransaction), true);
            foreach ($data['detail_transaction_goods'] as $key => $value) {
                $getDataTransaction = TG::GetByIdDetailTransaction($value['id']);
                $check = json_decode(json_encode($getDataTransaction), true);
        
                $data['detail_transaction_goods'][$key]['transaction_goods'] = $check;
             
            }
        return view('admin/report/report',$data);
    }
    public function create() {
        echo "<pre>";
        print_r(Input::all());die;
            //get Data session for creator
            if (!empty(Input::get('id'))) {
            $return =$this->update(Input::all());
            return $return;
            }else {
            $return = $this->save(Input::all());
            return $return;
            }

}
    public function save($data) {
        // echo "<pre>";
        // print_r($data);die;
        if (empty(Input::file('picture'))) {
            $return['status'] = false;
            $return['messages'] ='Silahkan isi nota';
            $return['data'] =[];
            return $return;
        }
        DB::beginTransaction();
    try {
        $dataSession = \Session::get('auth');
        $picture =$this->uploadfile('picture');
        $goods =new DTG;
        $goods->location_id =$data['location_id'];
        $goods->shift =$data['shift'];
        $goods->created_at =date('Y-m-d H:i:s');
        $goods->updated_at=date('Y-m-d H:i:s');
        $goods->price= str_replace('.','',$data['price']);
        $goods->description= $data['description'];
        $goods->date_transaction= date('Y-m-d',strtotime($data['date_transaction']));
        $goods->created_by=$dataSession['id'];
        $goods->file_path = $picture;  
        $goods->status_id = 1;  
        $goods->income = 0;
        $goods->save(); 
        
        $quantity = json_decode($data['quantity'], true);
        $name_goods = json_decode($data['name_goods'], true);
            foreach ($name_goods as $key => $value) {
                $transactionGoods =new TG;
                $transactionGoods->detail_transaction_id = $goods->id;
                $transactionGoods->food_id = $value;
                $transactionGoods->created_at =date('Y-m-d H:i:s');
                $transactionGoods->updated_at=date('Y-m-d H:i:s');
                $transactionGoods->created_by=$dataSession['id'];
                $transactionGoods->quantity = $quantity[$key];
                $transactionGoods->save();
            }
        DB::commit();
        // all good
        } catch (\Exception $e) {
            DB::rollback();
            $return['status'] = false;
            $return['messages'] =$e;
            $return['data'] =[];
            return $return;
        }
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
        $data = DTG::GetByID($id);
        $getDataTransaction = TG::GetByIdDetailTransaction($data['id']);
        $getDataTransaction = json_decode(json_encode($getDataTransaction), true);
        $data['transaction_goods'] = $getDataTransaction;
        $data['date_transaction'] = date("m/d/Y",strtotime($data['date_transaction']));
        if ($data) {
            $data['submit'] = "Update";
            $json['status'] = true;
            $json['messages'] = 'Success';
            $json['data'] = $data;
        }else{
            $json['status'] = false;
            $json['messages'] = 'Failed';
            $json['data'] = [];
        }
         //send view with data
         return Response::json($json);
    }
    public function showAjax(){
        $id = Input::get('id');
        $data = DTG::GetByID($id);
            $getDataTransaction = TG::GetByIdDetailTransaction($data['id']);
            $getDataTransaction = json_decode(json_encode($getDataTransaction), true);
            $data['transaction_goods'] = $getDataTransaction;
        $list['data'] =$data;
       return view('admin/food/show',$list);
   }
  public function printPrecord(){
    $id = Input::get('id');
    $data = DTG::GetByID($id);
    $getDataTransaction = TG::GetByIdDetailTransaction($data['id']);
    $getDataTransaction = json_decode(json_encode($getDataTransaction), true);
    $data['transaction_goods'] = $getDataTransaction;
    $list['data'] =$data;
        
   return view('admin/food/show_print',$list);
   }
   public function getGoodsDetail(){
        $id = Input::get('id');
        $edit = Input::get('edit');
        if (!empty($edit)) {
        $data['goods'] = 
        $queryNameCategory =GS::where('id',$id)->toArray();
        //   $data = Category::getBrand($id);
            $list =$data;
            return Response::json($list);
        }else{
            foreach ($id as $key => $value) {
                $queryNameCategory[] =GS::where('id',$value)->get()->toArray();
            }
            $list['data']=$queryNameCategory;
            $sent = view('admin/food/form_goods',$list)->render();
            return Response::json($sent);
        }
    }
    public function delete($id)
    {
        try {
            $detail = DTG::find($id);
            $detail->status_id = 3;
            $detail->update();
        } catch (\Exception $e) {
            \Session::flash('DeleteFails', 'this data is used in other tables');
            return \Redirect::to(route('food.index'));
        }

        \Session::flash('DeleteSucces', 'SUCCESS');
        return \Redirect::to(route('food.index'));
    }

}