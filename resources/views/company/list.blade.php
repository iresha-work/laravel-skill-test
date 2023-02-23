<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="">
                <h5 class="card-title">{{ __('Company List') }}</h5>
                <a href="{{ route('company.create') }}" class="btn btn-primary btn-sm active mb-3" role="button" aria-pressed="true">{{ __('New Company') }}</a>
                    <table id="companies" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>WebSite</th>
                                <th class="text-center">Logo</th>
                                <th class="text-center">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{$company->name}}</td>
                                    <td>{{$company->email}}</td>
                                    <td>
                                        @if($company->website != '')
                                            <a href="{{$company->website}}" target="_blank">Link</a>
                                        @endif
                                    </td>
                                    <td class="text-center"><img class="text-cente" width="28"  height="28" src="{{asset('storage/'.$company->logo)}}" alt="{{$company->logo}}" ></td>
                                    <td class="text-center text-info"><a href="{{route('company.view' ,$company->id )}}"><i class="bi bi-eyedropper"></i></a></td>
                                  
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function () {
        $('#companies').DataTable();
    });
</script>
