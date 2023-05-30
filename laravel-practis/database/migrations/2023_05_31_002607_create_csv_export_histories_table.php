<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('csv_export_histories', function (Blueprint $table) {
            $table->id()->comment('ID');
            $table->string('file_name')->comment('ファイル名');
            $table->string('file_path')->comment('ファイルパス');
            $table->string('exported_by')->comment('エクスポート実行者');
            $table->string('exported_at')->comment('エクスポート実行日時');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('csv_export_histories');
    }
};
