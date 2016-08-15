<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use \CodeDelivery\Models\OrderItem;
class Order extends Model implements Transformable
{
    use TransformableTrait;
    protected $fillable= ['client_id',
                         'deliveryman_id',
                         'total',
                         'status',
                         ];
    
    public function deliveryman(){
        return $this->belongsTo(User::class);
    }
    
    public function client(){
        return $this->hasMany(Client::class);
    }
    public function items(){
            return $this->hasMany(OrderItem::class);
        }

}
