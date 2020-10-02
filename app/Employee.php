<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
    'name', 'phone', 'address', 'salary'
    ];
    
    
    public function user(){
        return $this->hasOne('App\User');
    }
    
    public function transactions(){
        return $this->hasMany('App\Transaction');
    }
    
    public function salaries(){
        return $this->hasMany('App\Salary');
    }
    
    public function monthlyTransactions($month = null){
        $month = $month == null ? date('Y-m') : $month;
        return $this->transactions->where('month', $month);
    }
    
    // public function delete(){
    //     foreach ($this->transactions as $transaction) {
    //         $transaction->delete();
    //     }
    //     foreach ($this->salaries as $salary) {
    //         $salary->delete();
    //     }
    //     $salary->user();
    //     $result =  parent::delete();
    //     return $result;
    // }
}