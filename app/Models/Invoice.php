<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;



class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';  

    protected $fillable = [  
        'no_invoice',  
        'proyek_id',  
        'tanggal',  
        'catatan',  
    ];

    public function client(): BelongsTo  
    {  
        return $this->belongsTo(Client::class);  
    } 
  
    public function kwitansi(): HasMany  
    {  
        return $this->hasMany(Kwitansi::class, 'invoice_id'); 
    }

    public function details(): HasMany 
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id'); // Jika satu invoice punya banyak detail
    }
    
    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class);
    }
    
    public function pembayaran(): HasMany  
    {  
        return $this->hasMany(Pembayaran::class, 'invoice_id'); 
    }

    public function getTanggalFormattedAttribute()
    {
        return $this->tanggal ? \Carbon\Carbon::parse($this->tanggal)->format('d/m/Y') : '-';
    }

    public function scopeFilterInvoice(Builder $query) : void {
        
        $query
        ->where('no_invoice', 'like', '%'.\request('search_invoice').'%')
        ->orWhere('tanggal', 'like', '%'.\request('search_invoice').'%')
        ->orWhere('catatan', 'like', '%'.\request('search_invoice').'%')
        ->orWhereHas('proyek', function ($proyek_query) {
            $proyek_query->whereHas('client', function ($client_query){
                $client_query->where('nama_client', 'like', '%'.\request('search_invoice').'%');
            });
            })
        ->orwhereHas('proyek', function ($proyek_query) {
            $proyek_query->where('no_proyek', 'like', '%'.request('search_invoice').'%');
            })
        ;
    }
    
}
