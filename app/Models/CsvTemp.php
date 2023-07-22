<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvTemp extends Model
{
    use HasFactory;

   
    protected $table = 'csv_temp';

   
    protected $primaryKey = 'id';

 
    protected $fillable = [
        'date_c',
        'academic_year_c',
        'session_c',
        'voucher_type_c',
        'voucher_no_c',
        'roll_no_c',
        'admno_c',
        'fee_category_c',
        'faculty_c',
        'receipt_no_c',
        'fee_head_c',
        'due_amount_c',
        'paid_amount_c',
        'concession_amount_c',
        'scholarship_amount_c',
        'reverse_concession_amount_c',
        'write_off_amount_c',
        'adjusted_amount_c',
        'refund_amount_c',
        'fund_tranCfer_amount_c'
    ];

    
    protected $casts = [
        'due_amount_c' => 'decimal:2',
        'paid_amount_c' => 'decimal:2',
        'concession_amount_c' => 'decimal:2',
        'scholarship_amount_c' => 'decimal:2',
        'reverse_concession_amount_c' => 'decimal:2',
        'write_off_amount_c' => 'decimal:2',
        'adjusted_amount_c' => 'decimal:2',
        'refund_amount_c' => 'decimal:2',
        'fund_tranCfer_amount_c' => 'decimal:2'
    ];
}
?>