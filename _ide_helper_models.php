<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Bank Model.
 *
 * @property int $id
 * @property string $sandi_bank
 * @property string $nama_bank
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank query()
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Bank whereSandiBank($value)
 */
	class Bank extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BankPondok
 *
 * @property int $id
 * @property string $kode
 * @property string $nama_bank
 * @property string $nama_rekening
 * @property string $nomor_rekening
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BankPondokFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok query()
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereNamaRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereNomorRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankPondok whereUpdatedAt($value)
 */
	class BankPondok extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Biaya
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string $nama
 * @property int $jumlah
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Biaya> $children
 * @property-read int|null $children_count
 * @property-read Biaya|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Santri> $santri
 * @property-read int|null $santri_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\BiayaFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya query()
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereJumlah($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Biaya whereUserId($value)
 */
	class Biaya extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Pembayaran
 *
 * @property int $id
 * @property int|null $bank_pondok_id
 * @property int|null $wali_bank_id
 * @property int $tagihan_id
 * @property int $wali_id
 * @property \Illuminate\Support\Carbon $tanggal_bayar
 * @property \Illuminate\Support\Carbon|null $tanggal_konfirmasi
 * @property float $jumlah_dibayar
 * @property string|null $bukti_bayar
 * @property string $metode_pembayaran
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\BankPondok|null $bankPondok
 * @property-read \App\Models\Tagihan|null $tagihan
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $wali
 * @property-read \App\Models\WaliBank|null $waliBank
 * @method static \Database\Factories\PembayaranFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereBankPondokId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereBuktiBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereJumlahDibayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereMetodePembayaran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTagihanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTanggalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereTanggalKonfirmasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereWaliBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pembayaran whereWaliId($value)
 */
	class Pembayaran extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Santri
 *
 * @property int $id
 * @property int|null $wali_id
 * @property string|null $wali_status
 * @property string $nama
 * @property string $nis
 * @property string $gender
 * @property string $kelas
 * @property string $jenis_spp
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $biaya_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Biaya|null $biaya
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\ModelStatus\Status> $statuses
 * @property-read int|null $statuses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tagihan> $tagihan
 * @property-read int|null $tagihan_count
 * @property-read \App\Models\User|null $user
 * @property-read \App\Models\User|null $wali
 * @method static \Illuminate\Database\Eloquent\Builder|Santri currentStatus(...$names)
 * @method static \Database\Factories\SantriFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Santri newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Santri newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Santri otherCurrentStatus(...$names)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri query()
 * @method static \Illuminate\Database\Eloquent\Builder|Santri search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereBiayaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereJenisSpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereNis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereWaliId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Santri whereWaliStatus($value)
 */
	class Santri extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tagihan
 *
 * @property int $id
 * @property int $santri_id
 * @property int $user_id
 * @property string $jenis
 * @property int $biaya_id parent biaya
 * @property string|null $jenis_spp
 * @property string|null $kelas
 * @property \Illuminate\Support\Carbon $tanggal_tagihan
 * @property \Illuminate\Support\Carbon|null $tanggal_lunas
 * @property \Illuminate\Support\Carbon $tanggal_jatuh_tempo
 * @property string|null $keterangan
 * @property float|null $denda
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Biaya|null $biaya
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pembayaran> $pembayaran
 * @property-read int|null $pembayaran_count
 * @property-read \App\Models\Santri|null $santri
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TagihanDetail> $tagihanDetails
 * @property-read int|null $tagihan_details_count
 * @property-read \App\Models\User|null $user
 * @method static \Database\Factories\TagihanFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan search($search, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan searchRestricted($search, $restriction, $threshold = null, $entireText = false, $entireTextOnly = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan waliSantri()
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereBiayaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereDenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereJenis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereJenisSpp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereKelas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereSantriId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalJatuhTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalLunas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereTanggalTagihan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tagihan whereUserId($value)
 */
	class Tagihan extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TagihanDetail
 *
 * @property int $id
 * @property int $tagihan_id
 * @property string $nama_biaya
 * @property int $jumlah_biaya
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TagihanDetailFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail query()
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereJumlahBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereNamaBiaya($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereTagihanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TagihanDetail whereUpdatedAt($value)
 */
	class TagihanDetail extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $akses
 * @property string $name
 * @property string $nohp
 * @property string|null $nohp_verified_at
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Activitylog\Models\Activity> $activities
 * @property-read int|null $activities_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Santri> $santri
 * @property-read int|null $santri_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User wali()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAkses($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNohp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNohpVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

namespace App\Models{
/**
 * App\Models\WaliBank
 *
 * @property int $id
 * @property int $wali_id wali id adalah primary key dari user id
 * @property string $kode
 * @property string $nama_bank
 * @property string $nama_rekening
 * @property string $nomor_rekening
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\WaliBankFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank query()
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereKode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereNamaBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereNamaRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereNomorRekening($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WaliBank whereWaliId($value)
 */
	class WaliBank extends \Eloquent {}
}

