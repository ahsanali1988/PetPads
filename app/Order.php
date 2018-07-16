<?php

namespace App;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    use Filterable;

    /**
     * The attributes that should be guarded for arrays.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be fillable for arrays.
     *
     * @var array
     */
    protected $fillable = [
        'phone',
        'company',
        'first_name',
        'last_name',
        'email',
        'street',
        'street2',
        'city',
        'state',
        'postal_code',
        'country',
        'date_time',
        'data_value',
        'data_descriptor',
        'credit_card_number',
        'b_street',
        'b_street2',
        'b_city',
        'b_state',
        'b_postal_code',
        'b_phone_no',
        'billing_bit',
        'order_no',
        'special_discount',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'user_id',
    ];

    public function getOrderDetails() {
        return $this->hasMany('App\OrderDetail');
    }

    public function getUser() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getProductFeedbacks() {
        return $this->hasMany('App\ProducFeedback');
    }

    public static function getFeedbackPending($user_id, $product_id) {
        return Order::select('orders.*')
                        ->where('orders.user_id', $user_id)
                        ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
                        ->leftJoin('product_feedbacks', 'orders.id', '=', 'product_feedbacks.order_id')
                        ->where('order_details.product_id', $product_id)
                        ->where('orders.payment_status', 1)
                        ->where('orders.status', 4)
                        ->whereNull('product_feedbacks.id')
                        ->get();
    }

    public function getOrderTransactionDetails() {
        return $this->hasMany('App\OrderTransactionDetail');
    }

    public function isAutoship() {
        $isAutoship = $this->getOrderDetails()
                ->where('autoship_interval', '>', 0)
                ->first();
        if ($isAutoship) {
            return true;
        }
        return false;
    }

    public function getErrorDescription() {
        return $this->getOrderDetails()
                        ->where('error_description', '<>', '')
                        ->first();
    }

    public function getName(){
        return $this->first_name . " " . $this->last_name;
    }

    public static function getPendingOrders(){
        return Order::select('orders.*')
            ->leftJoin('order_transaction_details', 'orders.id', '=', 'order_transaction_details.order_id')
            ->whereNotIn('order_transaction_details.shipping_status', [4,5])
            ->orderBy('order_transaction_details.id', 'desc')
            ->groupBy('orders.id')
            ->get();
    }

}
