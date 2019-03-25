<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Foods extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'foods';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'name','unit','updated_at','created_at','created_by','status_id'];

}
