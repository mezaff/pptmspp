<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];
    protected $dates = ['tanggal_bayar', 'tanggal_konfirmasi'];
    protected $with = ['user', 'tagihan'];
    protected $append = ['status_konfirmasi'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
    }

    protected function getStatusStyleAttribute()
    {
        if ($this->tanggal_konfirmasi == null) {
            return 'secondary';
        }
        return 'success';
    }

    protected function statusKonfirmasi(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->tanggal_konfirmasi == null) ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi '
        );
    }

    /**
     * Get the tagihan that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tagihan(): BelongsTo
    {
        return $this->belongsTo(Tagihan::class);
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The "booted" method of the model.
     * 
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::updated(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::deleted(function ($pembayaran) {
            $pembayaran->tagihan->updateStatus();
        });

        static::creating(function ($pembayaran) {
            $pembayaran->user_id = auth()->user()->id;
        });

        static::updating(function ($pembayaran) {
            $pembayaran->user_id = auth()->user()->id;
        });
    }

    /**
     * Get the user that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wali(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    /**
     * Get the bankPondok that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bankPondok(): BelongsTo
    {
        return $this->belongsTo(BankPondok::class);
    }

    /**
     * Get the waliBank that owns the Pembayaran
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function waliBank(): BelongsTo
    {
        return $this->belongsTo(WaliBank::class);
    }
}
