<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Santri extends Model
{
    use HasFactory;
    use LogsActivity;
    use SearchableTrait;
    use HasStatuses;
    protected $guarded = [];
    protected $searchable = [
        'columns' => [
            'nama' => 10,
            'nis' => 10,
        ],
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded();
    }

    //set foto default
    protected function getFotoAttribute($value)
    {
        $defaultFoto = 'images/user2.png';
        return $defaultFoto;
    }

    /**
     * Get the biaya that owns the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function biaya(): BelongsTo
    {
        return $this->belongsTo(Biaya::class);
    }

    /**
     * Get the user that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the wali that owns the Siswa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function wali(): BelongsTo
    {
        return $this->belongsTo(User::class, 'wali_id');
    }

    /**
     * Get all of the tagihan for the Santri
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tagihan(): HasMany
    {
        return $this->hasMany(Tagihan::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function ($santri) {
            $santri->user_id = auth()->user()->id;
        });

        static::created(function ($santri) {
            $santri->setStatus('aktif');
        });

        static::updating(function ($santri) {
            $santri->user_id = auth()->user()->id;
        });
    }
}
