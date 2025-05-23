<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory;
    protected $table = 'proyek';

    protected $fillable = [
        'no_proyek',
        'tgl_mulai_kontrak',
        'tgl_selesai_kontrak',
        'klien_id',
        'termin',
        'biaya',
        'pajak',
        'biaya_lain'
    ];

    public function pembelians() : HasMany{
        return $this->hasMany(pembelian::class, 'proyekid');
    }

    public function scopeFilterNama(Builder $query) : void {
        $query
        ->whereHas('client', function ($proyek_query) {
            $proyek_query->where('nama_client', 'like', '%'.request('search_proyek').'%');
        })->orWhere('no_proyek', 'like', '%'.\request('search_proyek').'%');

    }

    public function client(): BelongsTo {
        return $this->belongsTo(Client::class, 'klien_id');
    }

    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class, 'proyek_id');
    }
}
