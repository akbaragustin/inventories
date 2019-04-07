<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Locations extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'locations';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'description', 'city', 'country', 'updated_at','created_at','created_by','status_id'];

    public static function GetTransaction($data,$income)
    {
        $input = Input::get('search.value');
        $get = Input::all();
        
        $where = "where detail_transaction_goods.status_id != 3";

        if (!empty($data['location_id'])) {
            $where .= " and locations.id = '".$data['location_id']."'";
        }
        if (!empty($data['date_transaction'])) {
            $where .= " and detail_transaction_goods.date_transaction = '".date("Y-m-d",strtotime($data['date_transaction']))."'";
        }
        if (!empty($data['shift'])) {
            $where .= " and detail_transaction_goods.shift = '".$data['shift']."'";
        }
        if ($income == true) {
            $where .= " and detail_transaction_goods.income = '".true."'";
        }else {
            $where .= " and detail_transaction_goods.income = '".false."'";
        }
        
        $query = "SELECT 
                locations.id as location_id,
                locations.name as location_name,
                locations.description,
                locations.city,
                locations.country,
                locations.status_id,
                detail_transaction_goods.id as detail_id,
                detail_transaction_goods.file_path,
                detail_transaction_goods.created_at,
                detail_transaction_goods.updated_at,
                detail_transaction_goods.created_by,
                detail_transaction_goods.shift,
                detail_transaction_goods.price,
                detail_transaction_goods.date_transaction,
                detail_transaction_goods.status_id,
                detail_transaction_goods.description,
                users.name as user_name
                FROM locations
                LEFT JOIN detail_transaction_goods on detail_transaction_goods.location_id = locations.id
                LEFT JOIN users on users.id = locations.created_by
                ".$where."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
    
    public static function GetFoodTransactionDetail($detail_id)
    {
    
       
        $where = " where transaction_goods.detail_transaction_id = '".$detail_id."'";
      
        $query = "SELECT 
                transaction_goods.id as transation_id,
                transaction_goods.quantity,
                foods.id as food_id,
                foods.name as food_name,
                foods.unit as food_unit
                FROM transaction_goods
                LEFT JOIN foods on foods.id = transaction_goods.food_id
                ".$where."
                ";
        $listData = \DB::select($query);
        return $listData;
    }
}
