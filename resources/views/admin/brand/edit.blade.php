<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Edit Brand
        </h2>
    </x-slot>

    <div class="py-12">
     <div class="container">
      <div class="row">
        

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Edit Brand </div>
                <div class="card-body">
                <form action="{{ url('brand/update/'.$brands->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" class="form-control" id="brandname" name="brand_name" aria-describedby="emailHelp" value="{{ $brands->brand_name }}">

                                    @error('brand_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Image</label>
                                    <input type="file" class="form-control" id="brandimage" name="brand_image" aria-describedby="emailHelp">

                                    @error('brand_image')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>
               
                <button type="submit" class="btn btn-primary">Update Brand</button>
                </form>
                </div>
            </div>
        </div>
      </div>
     </div>
    </div>
</x-app-layout>
