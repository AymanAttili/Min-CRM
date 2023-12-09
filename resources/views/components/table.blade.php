@props(['records', 'model'])

<div class="mx-auto w-3/4 relative mt-4">
    <div class="text-xl p-6 bg-gray-800 h-14 flex justify-between">
        <h1 class="text-white">
            @if($model == 'company')
                Companies
            @elseif($model == 'employee')
                Employees
            @endif
        </h1>
        @auth
            <x-crud.add-record-button :model="$model"/>
        @endauth
    </div>
    <table class="w-full bg-white shadow-md rounded my-6 text-gray-800">
        <thead>
        <tr class="bg-gray-200 bg-indigo-50">
            <th class="text-left py-2 px-4 border">#</th>
            <th class="text-left py-2 px-4 border">Name</th>
            <th class="text-left py-2 px-4 border">Email</th>
            @if(Auth::check() && Auth::user()->role == 'user')
                <th class="text-left py-2 px-4 border">Phone</th>
            @else
                <th class="text-left py-2 px-4 border">Website</th>
            @endif

            @auth
                <th class="text-left py-2 px-4">Actions</th>
            @endauth
        </tr>
        </thead>
        <tbody>
        @foreach ($records as $record)
            <tr class="hover:bg-gray-100">
                <td class="border py-2 px-4">{{ $record->id }}</td>

                @if(Auth::check() && Auth::user()->role == 'user')
                    <td class="border py-2 px-4">{{ $record->firstName . ' ' . $record->lastName }}</td>
                @else
                    <td class="border py-2 px-4">{{ $record->name }}</td>
                @endif

                @if(Auth::check() && Auth::user()->role == 'user')
                    <td class="border py-2 px-4">{{ $record?->user?->email ?  : ''}}</td>
                @else
                    <td class="border py-2 px-4">{{ $record->email }}
                @endif

                @if(Auth::check() && Auth::user()->role == 'user')
                    <td class="border py-2 px-4">{{ $record->phone }}</td>
                @else
                    <td class="border py-2 px-4">{{ $record->website_link }}</td>
                @endif

                @auth
                    <td class="border py-2 px-4 flex justify-center gap-4">
                        @if(Auth::user()->role == 'admin')
                            <x-crud.edit-company-button :record="$record"/>
                        @elseif(Auth::user()->role == 'user')
                            <x-crud.edit-employee-button :record="$record"/>
                        @endif
                        <x-crud.delete-record-button :record="$record" :model="$model"/>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
