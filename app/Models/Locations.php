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

}
