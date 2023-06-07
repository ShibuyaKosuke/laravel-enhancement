<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CSV Download History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>ダウンロードしたユーザー</th>
                        <th>ファイル名</th>
                        <th>出力日時</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($csvExportHistories as $csvExportHistory)
                        <tr>
                            <td>{{ $csvExportHistory->id }}</td>
                            <td>{{ $csvExportHistory->exportedBy->name }}</td>
                            <td>{{ Html::linkRoute('csv-export-histories.show', $csvExportHistory->file_name, $csvExportHistory) }}</td>
                            <td>{{ $csvExportHistory->exported_at }}</td>
                            <td>{{ $csvExportHistory->created_at }}</td>
                            <td>{{ $csvExportHistory->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
