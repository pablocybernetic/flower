<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = ['name','email','phone','amount','address','status','transaction_id','currency', 'MpesaReceiptNumber','AmountPaid','ResultDesc', 'ResultCode'];

}
