<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Assets extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'asset_transactions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'name', 'description', 'shift', 'type', 'updated_at','created_at','created_by','status_id','location_id','file_path','date_transaction','quantity','price'];
   
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
                    asset_transactions.status_id,
                    asset_transactions.price,
                    asset_transactions.quantity,
                    asset_transactions.status_id,
                    asset_transactions.price,
                    asset_transactions.quantity,
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
    public static function getByID($id)
    {
        $where = "where asset_transactions.id = '".$id."'";
        $query = " select 
                    asset_transactions.id,
                    asset_transactions.name,
                    asset_transactions.status_id,
                    asset_transactions.price,
                    asset_transactions.quantity,
                    asset_transactions.status_id,
                    asset_transactions.price,
                    asset_transactions.quantity,
                    asset_transactions.created_by,
                    asset_transactions.file_path,
                    asset_transactions.date_transaction,
                    asset_transactions.location_id,
                    asset_transactions.description,
                    asset_transactions.created_at,
                    asset_transactions.updated_at,
                    asset_transactions.shift,
                    locations.name as location_name,
                    locations.city,
                    locations.country,
                    users.name as user_name
                    from asset_transactions
                    LEFT JOIN locations ON locations.id  = asset_transactions.location_id
                    LEFT JOIN users ON users.id  = asset_transactions.created_by
                    ".$where."
                ";
        $listData = \DB::select($query);

        return $listData;
    }
    
}
