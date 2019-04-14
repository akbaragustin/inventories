<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class DetailTransactionGoods extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'detail_transaction_goods';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'file_path', 'location_id','description','updated_at','created_at','shift','price','status_id','date_transaction','income'];
   
    public static function getAll()
    {

        $input = Input::get('search.value');
        $get = Input::all();
        
        $where = "where detail_transaction_goods.status_id != 3 and detail_transaction_goods.income = 0";


        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if (!empty($start) AND !empty($length)) {
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select 
                    detail_transaction_goods.id,
                    detail_transaction_goods.status_id,
                    detail_transaction_goods.price,
                    detail_transaction_goods.created_by,
                    detail_transaction_goods.file_path,
                    detail_transaction_goods.date_transaction,
                    detail_transaction_goods.location_id,
                    detail_transaction_goods.description,
                    detail_transaction_goods.shift,
                    locations.name as location_name,
                    locations.city,
                    locations.country
                    from detail_transaction_goods
                    LEFT JOIN locations ON locations.id  = detail_transaction_goods.location_id
                ".$where."
                ".$limit."
                ";
        
        $listData = \DB::select($query);
        return $listData;
    }  public static function getAllOutCome()
    {

        $input = Input::get('search.value');
        $get = Input::all();
        
        $where = "where detail_transaction_goods.status_id != 3 and detail_transaction_goods.income = 1";


        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if (!empty($start) AND !empty($length)) {
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select 
                    detail_transaction_goods.id,
                    detail_transaction_goods.status_id,
                    detail_transaction_goods.price,
                    detail_transaction_goods.created_by,
                    detail_transaction_goods.file_path,
                    detail_transaction_goods.date_transaction,
                    detail_transaction_goods.location_id,
                    detail_transaction_goods.description,
                    detail_transaction_goods.shift,
                    locations.name as location_name,
                    locations.city,
                    locations.country
                    from detail_transaction_goods
                    LEFT JOIN locations ON locations.id  = detail_transaction_goods.location_id
                ".$where."
                ".$limit."
                ";
        
        $listData = \DB::select($query);
        return $listData;
    }
    public static function getByID($id)
    {   
        $where = "where detail_transaction_goods.status_id != 3";
        $where .= " and detail_transaction_goods.id = '".$id."'";
        $query = " select 
                    detail_transaction_goods.id,
                    detail_transaction_goods.status_id,
                    detail_transaction_goods.price,
                    detail_transaction_goods.created_by,
                    detail_transaction_goods.file_path,
                    detail_transaction_goods.date_transaction,
                    detail_transaction_goods.location_id,
                    detail_transaction_goods.description,
                    detail_transaction_goods.shift,
                    detail_transaction_goods.created_at,
                    detail_transaction_goods.updated_at,
                    locations.name as location_name,
                    locations.city,
                    locations.country,
                    users.name as user_name
                    from detail_transaction_goods
                    LEFT JOIN locations ON locations.id  = detail_transaction_goods.location_id
                    LEFT JOIN users ON users.id  = detail_transaction_goods.created_by
                ".$where."
                ";
        $listData = \DB::select($query);
        $listData = json_decode(json_encode($listData), true);
        return $listData[0];
    }
    public static function GetFoodByLocationID($id){
        $where = "where detail_transaction_goods.status_id != 3";
        $where .= " and detail_transaction_goods.location_id ='".$id."'";
            $query = " select 
                detail_transaction_goods.id as detail_id,
                detail_transaction_goods.location_id,
                detail_transaction_goods.income,
                transaction_goods.id as transaction_id,
                transaction_goods.quantity,
                foods.id as food_id,
                foods.name as food_name,
                foods.unit 
                from detail_transaction_goods
                LEFT JOIN transaction_goods ON transaction_goods.detail_transaction_id  = detail_transaction_goods.id
                LEFT JOIN foods ON foods.id = transaction_goods.food_id
            ".$where."
            ";
        $listData = \DB::select($query);
        $listData = json_decode(json_encode($listData), true);
        return $listData;
    }
}
