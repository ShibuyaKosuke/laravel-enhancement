<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Companies') }}
        </h2>
    </x-slot>

    {{ Form::open(['route' => 'users.index', 'method' => 'get']) }}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ Form::select('company_id', $companies, request('company_id'), ['placeholder' => '会社を選択']) }}
            {{ Form::select('section_id', [], null, ['placeholder' => '部署を選択', 'data-default' => request('section_id')]) }}
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ Form::submit('検索') }}
            {{ Html::linkRoute('download.users', 'ダウンロード', request()->query()) }}
        </div>
    </div>
    {{ Form::close() }}

    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>会社名</th>
                        <th>氏名</th>
                        <th>メールアドレス</th>
                        <th>部署</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->company->name }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->sections->implode(',') }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
