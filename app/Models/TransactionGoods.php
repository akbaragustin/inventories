<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class TransactionGoods extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'transaction_goods';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'detail_transaction_id', 'food_id',  'updated_at','created_at','created_by','quantity'];
   
    public static function getAll()
    {

        $input = Input::get('search.value');
        $get = Input::all();
        
        $where = "where asset_transactions.status_id != 3";


        // limit 10 OFFSET 1
        $start = Input::get('start');
        $length = Input::get('length');
        $limit ="";
        if (!empty($start) AND !empty($length)) {
        $limit  = "LIMIT ".$length." OFFSET ".$start;
        }
        $query = " select 
                    asset_transactions.id,
                    asset_transactions.name,
                    asset_transactions.price,
                    asset_transactions.created_by,
                    asset_transactions.file_path,
                    asset_transactions.date_transaction,
                    asset_transactions.location_id,
                    asset_transactions.description,
                    asset_transactions.shift,
                    locations.name as location_name,
                    locations.city,
                    locations.country
                    from asset_transactions
                    LEFT JOIN locations ON locations.id  = asset_transactions.location_id
                ".$where."
                ".$limit."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
    public static function GetByIdDetailTransaction($id)
    {
        $where = "where transaction_goods.detail_transaction_id = '".$id."'";
        $query = " select 
                    transaction_goods.id,
                    transaction_goods.quantity,
                    transaction_goods.food_id,
                    foods.name as food_name,
                    foods.unit as food_unit
                    from transaction_goods
                    LEFT JOIN foods ON foods.id  = transaction_goods.food_id
                    ".$where."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
    
}
