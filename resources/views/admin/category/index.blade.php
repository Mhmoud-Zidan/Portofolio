<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <b>Hi.. {{ Auth::user()->name }}</b>
      <b style="float:right;"> Total Categories
        <span class="badge badge-danger">{{ count($categories) }}</span>
      </b>
    </h2>
  </x-slot>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        @if (session()->has('message'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="card">
          <div class="card-header">
            Categories
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">SL NO</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">User</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($categories as $category)
                  <tr>
                    <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td class="row">
                      <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info mr-1">Edit</a>
                      <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure ?');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>

                    </td>

                  </tr>
                @empty
                  <p>No Data Set</p>
                @endforelse
              </tbody>
            </table>
            {{ $categories->links() }}
          </div>
        </div>

        {{-- trashed categories --}}
        <div class="card">
          <div class="card-header">
            Trashed Categories
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">SL NO</th>
                  <th scope="col">Category Name</th>
                  <th scope="col">User</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($trashedCategories as $category)
                  <tr>
                    <th scope="row">{{ $categories->firstItem() + $loop->index }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->user->name }}</td>
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    <td class="row">
                      <a href="{{ route('categories.restore', $category->id) }}"
                        class="btn btn-success mr-1">Restore</a>
                      {{-- js alert not working --}}
                      <a href="{{ route('categories.p-delete', $category->id) }}" class="btn btn-warning mr-1"
                        onclick="return confirm('Are you sure ?');">P Delete</a>
                    </td>
                  </tr>
                @empty
                <tr>
                    <td class="text-center" colspan="7">
                      <h6>No Data Set </h6>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
            {{ $trashedCategories->links() }}
          </div>
        </div>
        {{-- end trashed --}}
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Add Category
          </div>
          <div class="card-body">
            <form action="{{ route('categories.store') }}" method="POST">
              @csrf
              <input type="hidden" name="user_id" value={{ \Auth::id() }}>
              <div class="form-group">
                <label for="inputCategory">Category Name</label>

                <input id="inputCategory" type="text" name="name"
                  class="form-control  @error('name') is-invalid value @enderror">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>




</x-app-layout>
