<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';

    protected $fillable = ['invoice_id', 'deskripsi', 'harga', 'qty', 'total'];

    public function details()
    {
        return $this->belongsTo(Invoice::class);
    }
}
