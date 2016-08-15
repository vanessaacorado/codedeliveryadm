<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \CodeDelivery\Models\OrderItem;
use \CodeDelivery\Models\Client;
class Order extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable= ['client_id',
                         'user_deliveryman_id',
                         'total',
                         'status',
                         ];
    
    public function deliveryman(){
        return $this->belongsTo(User::class,'user_deliveryman_id','id');
    }
    
    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function items(){
            return $this->hasMany(OrderItem::class);
        }

}
