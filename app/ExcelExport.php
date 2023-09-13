<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExcelExport extends Model
{
    protected $table = 'excelexport';
	
    protected $fillable = [
        'ItemName', 'ItemCode', 'Date', 'Price', 'Quantity', 'description', 'image'
    ];
}
