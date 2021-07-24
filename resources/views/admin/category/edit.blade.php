<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <b>Edit Category {{ $category->name }}</b>
      </x-slot>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
              Edit Category
            </div>
            <div class="card-body">
              <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('put')
                <label for="inputName">Category Name</label>
                <input type="hidden" name="user_id" value={{ \Auth::id() }}>
                <input id="inputName" type="text" name="name" value = {{ old('name', $category->name) }} class="form-control  @error('name') is-invalid value @enderror">
              @error('name')
                <small class="text-danger">{{ $message }}</small>
              @enderror

                <div class="mt-2">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
              </form>
            </div>
          </div>
    </div>

</x-app-layout>
