<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <b>Hi.. {{ Auth::user()->name }}</b>
      <b style="float:right;"> Total Images
        <span class="badge badge-danger">{{ count($pics) }}</span>
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

        <div class="card-group">
          @forelse ($pics as $pic)
            <div class="col-md-4 p-3">
              <div class="card">
                <img src="{{ asset($pic->image) }}" alt="one of multi pics">
              </div>

            </div>

          @empty
          <div class="col-md-8 text-center">
              <h4>No Data Set</h4>
        </div>
          @endforelse
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Add Image
          </div>
          <div class="card-body">
            <form action="{{ route('pics.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label for="picImage">Images</label>
                <input id="picImage" type="file" name="image[]" multiple=""
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
