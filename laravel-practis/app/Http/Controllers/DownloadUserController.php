<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DownloadUserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->with(['company', 'sections'])
            ->whereCompany($request)
            ->whereSection($request)
            ->orderBy('id')
            ->get();

        $callback = function () use ($users) {
            // @codeCoverageIgnoreStart
            $stream = $this->createCsv($users);

            echo stream_get_contents($this->createCsv($users));

            fclose($stream);
            // @codeCoverageIgnoreEnd
        };

        return response()->streamDownload($callback, 'users.csv');
    }

    /**
     * @return bool|resource
     *
     * @codeCoverageIgnore
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
