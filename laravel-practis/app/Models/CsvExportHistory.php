<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
