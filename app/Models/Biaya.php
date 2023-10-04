<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biaya extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    use LogsActivity;
    protected $guarded = [];
    protected $append = ['nama_biaya_full', 'total_tagihan'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
    }

    protected function totalTagihan(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->children()->sum('jumlah'),
        );
    }

    /**
     * Get the parent that owns the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Biaya::class, 'parent_id');
    }

    /**
     * Get all of the children for the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Biaya::class, 'parent_id');
    }

    /**
     * Interact with the user's first name.
     */
    protected function namaBiayaFull(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->nama . '  ( ' . $this->formatRupiah('jumlah') . ' )',
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the siswa for the Biaya
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function santri(): HasMany
    {
        return $this->hasMany(Santri::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($biaya) {
            $biaya->user_id = auth()->user()->id;
        });

        static::updating(function ($biaya) {
            $biaya->user_id = auth()->user()->id;
        });
    }
}
