<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <b>Hi.. {{ Auth::user()->name }}</b>
      <b style="float:right;"> Total Users
        <span class="badge badge-danger">{{ count($users) }}</span>
      </b>
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">SL NO</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Created At</th>
            </tr>
          </thead>
          <tbody>
            @php($i = 1)
            @forelse ($users as $user)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                {{-- for eloquent --}}
                <td>{{ $user->created_at->diffForHumans() }}</td>
                {{-- for quiru builder --}}
                {{-- <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td> --}}

              </tr>
            @empty
              <p>No Data Set</p>
            @endforelse

          </tbody>
        </table>
      </div>

    </div>
  </div>
</x-app-layout>
