<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use PhpParser\Node\Stmt\Return_;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Nicolaslopezj\Searchable\SearchableTrait;
use Barryvdh\Reflection\DocBlock\Tag\ReturnTag;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tagihan extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use LogsActivity;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'santris.nama' => 10,
            'santris.nis' => 10,
        ],
        'joins' => [
            'santris' => ['santris.id', 'tagihans.santri_id'],
        ],
    ];

    protected $guarded = [];
    protected $dates = ['tanggal_tagihan', 'tanggal_jatuh_tempo', 'tanggal_lunas'];
    protected $with = ['user'];
    protected $append = ['total_tagihan', 'total_tagihan'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
    }

    protected function getStatusStyleAttribute()
    {
        if ($this->status == 'lunas') {
            return 'success';
        }
        if ($this->status == 'angsur') {
            return 'warning';
        }
        if ($this->status == 'baru') {
            return 'primary';
        }
    }

    protected function totalPembayaran(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->pembayaran()->sum('jumlah_dibayar'),
        );
    }

    protected function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->tagihanDetails()->sum('jumlah_biaya'),
        );
    }

    //ubah status tagihan
    public function updateStatus()
    {
        if ($this->total_pembayaran >= $this->total_tagihan) {
            $tanggalBayar = $this->pembayaran()
                ->orderBy('tanggal_bayar', 'desc')
                ->first()
                ->tanggal_bayar;
            $this->update([
                'status' => 'lunas',
                'tanggal_lunas' => $tanggalBayar
            ]);
        }

        if ($this->total_pembayaran > 0 && $this->total_pembayaran < $this->total_tagihan) {
            $this->update(['status' => 'angsur', 'tanggal_lunas' => null]);
        }

        if ($this->total_pembayaran <= 0) {
            $this->update(['status' => 'baru', 'tanggal_lunas' => null]);
        }
    }

    /**
     * Get the user that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the santri that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class)->withDefault();
    }

    /**
     * Get all of the tagihanDetails for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihanDetails(): HasMany
    {
        return $this->hasMany(TagihanDetail::class);
    }

    /**
     * Get all of the pembayaran for the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function getStatusTagihanWali()
    {
        if ($this->status == 'baru') {
            return 'BELUM DIBAYAR';
        }
        if ($this->status == 'angsur') {
            return 'ANGSUR';
        }
        if ($this->status == 'lunas') {
            return 'LUNAS';
        }
        return $this->status;
    }

    public function scopeWaliSantri($q)
    {
        return $q->whereIn('santri_id', Auth::user()->getAllSantriId());
    }

    /**
     * Get the biaya that owns the Tagihan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biaya(): BelongsTo
    {
        return $this->belongsTo(Biaya::class);
    }
}
