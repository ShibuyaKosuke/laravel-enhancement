<?php

namespace App\Http\Controllers;

use App\Models\CsvExportHistory;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->with(['company', 'sections'])
            ->whereCompany($request)
            ->whereSection($request)
            ->orderBy('id')
            ->get();

        $file_name = sprintf('users-%s.csv', now()->format('YmdHis'));

        $stream = $this->createCsv($users);

        Storage::put($file_name, $stream);

        CsvExportHistory::create([
            'file_name' => $file_name,
            'file_path' => $file_name,
            'exported_by' => $request->user()->id,
            'exported_at' => now(),
        ]);

        return Storage::download($file_name);
    }

    /**
     * @param Collection $users
     * @return false|resource
     */
    private function createCsv(Collection $users)
    {
        $stream = fopen('php://temp', 'r+b');

        fputcsv($stream, ['id', 'name', 'email', 'company_id', 'company_name', 'section']);

        foreach ($users as $user) {
            fputcsv($stream, [
                $user->id,
                $user->name,
                $user->email,
                $user->company_id,
                $user->company->name,
                $user->sections->implode(','),
            ]);
        }

        rewind($stream);

        return $stream;
    }
}
