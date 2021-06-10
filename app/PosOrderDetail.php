<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosOrderDetail extends Model
{
    /**
     * Table name
     * @var String 
     */
    protected $table = 'order_details';

    /**
     * Primary key
     * @var String
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable
     * @var Array
     */
    protected $fillable = [
        'pv_id',
        'pv_sku',
        'unit_price',
        'order_id',
        'order_quantity',

    ];

    /**
     * ########################
     *     Helper Functions
     * ########################
     */

    /**
     * 
     */

    /**
     * ########################
     *      Relationship
     * ########################
     */

    /**
     * Many order details to one order.
     * @return App/PosOrder/
     */
    public function order(){
        return $this->belongsTo(
            PosOrder::class,
            'order_id',
        );
    }

    /**
     * 
     */

}
