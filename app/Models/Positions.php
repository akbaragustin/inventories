<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use DB;
class Positions extends Model {

    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'positions';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['id', 'name'];

}
