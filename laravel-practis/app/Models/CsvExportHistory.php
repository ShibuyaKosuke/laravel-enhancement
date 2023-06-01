<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CsvExportHistory
 *
 * @property int $id ID
 * @property string $file_name ファイル名
 * @property string $file_path ファイルパス
 * @property string $exported_by エクスポート実行者
 * @property string $exported_at エクスポート実行日時
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $exportedBy
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereExportedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereExportedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CsvExportHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CsvExportHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'exported_by',
        'exported_at',
    ];

    public function exportedBy()
    {
        return $this->belongsTo(User::class, 'exported_by');
    }
}
