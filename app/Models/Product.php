<?php

namespace App\Models;
use App\Http\Controllers\ProductController;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    // protected $dateFormat = 'U';
  
    protected $fillable=['name','description','price'];

    protected $casts = [
        'price' => 'int',
        'created_at'=>'date:Y-m-d',
        'updated_at'=>'date:Y-m-d'

    ];
   
   
    public function user()
    {
        return $this->belongsTo('App\Models\User','users_id','id');
    }
}
 