<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>Edit Brand {{ $brand->name }}</b>
      </x-slot>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
              Edit Brand
            </div>
            <div class="card-body">
              <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="inputName">Brand Name</label>
                    <input id="inputName" type="text" name="name" value={{ old('name', $brand->name) }} class="form-control  @error('name') is-invalid value @enderror">
                  @error('name')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group">
                    <label for="inputImage">Brand Image</label>
                    <input id="inputImage" type="file" name="image" class="form-control  @error('image') is-invalid value @enderror">
                  @error('image')
                    <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                {{-- show brand image --}}
                <div class="form-group">
                    <img src="{{ asset($brand->image) }}" alt="brand image" style="width:500px; height:300px;">
                </div>

                <div>
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </form>
            </div>
          </div>
    </div>

</x-app-layout>
