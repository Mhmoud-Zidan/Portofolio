<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <b>Hi.. {{ Auth::user()->name }}</b>
      <b style="float:right;"> Total Brands
        <span class="badge badge-danger">{{ count($brands) }}</span>
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
            Brands
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">SL NO</th>
                  <th scope="col">Brand Name</th>
                  <th scope="col">Image</th>
                  <th scope="col">Created At</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($brands as $brand)
                  <tr>
                    <th scope="row">{{ $brands->firstItem() + $loop->index }}</th>
                    <td>{{ $brand->name }}</td>
                    <td> <img src="{{ asset($brand->image) }}" alt="brand image" style="height: 40px; width:70px"></td>
                    <td>{{ $brand->created_at->diffForHumans() }}</td>
                    <td class="row">
                      <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-info mr-1">Edit</a>
                      <form action="{{ route('brands.destroy', $brand->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure ?');">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Delete</button>
                      </form>
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
            {{ $brands->links() }}
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Add Brand
          </div>
          <div class="card-body">
            <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label for="inputbrand">Brand Name</label>
                <input id="inputbrand" type="text" name="name"
                  class="form-control  @error('name') is-invalid value @enderror">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="form-group">
                <label for="brandImage">Brand Image</label>
                <input id="brandImage" type="file" name="image"
                  class="form-control  @error('image') is-invalid value @enderror">
                @error('image')
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
