<?php

namespace App\Http\Controllers;

use App\Models\CsvExportHistory;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CsvExportHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $csvExportHistories = CsvExportHistory::with(['exportedBy'])
            ->limit(10)
            ->latest()
            ->get();

        return view('csv_export_history.index', compact('csvExportHistories'));
    }

    /**
     * @param CsvExportHistory $csvExportHistory
     * @return StreamedResponse
     * @throws \Exception
     */
    public function show(CsvExportHistory $csvExportHistory): StreamedResponse
    {
        if (Storage::exists($csvExportHistory->file_path)) {
            return Storage::download($csvExportHistory->file_path);
        }
        throw new \Exception('ファイルが存在しません。'); // @codeCoverageIgnore
    }
}
