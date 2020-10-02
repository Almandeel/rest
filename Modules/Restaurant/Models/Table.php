<?php

namespace Modules\Restaurant\Models;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public const STATUS_AVAILABLE = 1;
    public const STATUS_UNAVAILABLE = 0;
    public const STATUSES = [
    self::STATUS_AVAILABLE => 'available',
    self::STATUS_UNAVAILABLE => 'unavailable',
    ];
    public const STATUSES_CLASSES = [
    self::STATUS_AVAILABLE => 'success',
    self::STATUS_UNAVAILABLE => 'warning',
    ];
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
    'number', 'status', 'hall_id',
    ];
    
    public function getStatus($type = 'value'){
        $status = is_null($this->closed_at) ? self::STATUS_OPEN : self::STATUS_CLOSED;
        if ($type == 'name') {
            return self::STATUSES[$status];
        }
        elseif ($type == 'class') {
            return self::STATUSES_CLASSES[$status];
        }
        return $status;


        if ($type == 'name') {
            return self::STATUSES[$this->status];
        }
        elseif ($type == 'class') {
            return self::STATUSES_CLASSES[$this->status];
        }
        return $this->status;
    }
    
    public function displayStatus($format = 'none'){
        $status = __('restaurant::tables.statuses.' . $this->getStatus('name'));
        if ($format == 'html') {
            $builder = '<span class="label label-' . $this->getStatus('class') . '">';
            $builder .= $status;
            $builder .= '</span>';
            
            return $builder;
        }
        return $status;
    }
    
    public function openOrders(){
        return $this->orders->where('status', Order::STATUS_OPEN);
    }
    
    public function closedOrders(){
        return $this->orders->where('status', Order::STATUS_CLOSED);
    }
    
    public function canceledOrders(){
        return $this->orders->where('status', Order::STATUS_CANCELED);
    }
    
    public function checkStatus($status){
        if ($status_type == 'string') {
            return $this->getStatus('name') == $status;
        }
        
        elseif ($status_type == 'integer') {
            return $this->getStatus() == $status;
        }
        
        throw new Exception("Unsupported status type", 1);
    }
    
    public function isAvailable(){
        return $this->checkStatus('available');
    }
    
    public function isUnavailable(){
        return $this->checkStatus('unavailable');
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }
    
    public function hall()
    {
        return $this->belongsTo(Hall::class, 'hall_id');
    }
    
    public static function boot(){
        parent::boot();
        static::creating(function($table){
            if (is_null($table->number)) {
                $table->number = Table::all()->count() + 1;
            }
        });
    }

    public static function allAvailable(){
        return static::with(['orders' => function($query) {
                    $query->where('status', '!=', Order::STATUS_OPEN)
                          ->whereNull('closed_at');
                }
            ])->get();
    }
}