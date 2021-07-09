<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brand
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">

                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        <div class="card-header">All Brand</div>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th scope="col">Brand name</th>
                                    <th scope="col">Brand image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <th>{{ $brands->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td><img src="{{ asset($brand->brand_image) }}" style="height:50px; width:50px;"alt="{{ $brand->brand_image }}"></img></td>
                                    @if($brand->created_at == NULL)
                                    <td> <span class="text-danger">No Date Set</span></td>
                                    @else
                                    <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                    @endif
                                    <td> <a href="{{ url('brand/edit/'.$brand->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('brand/softdelete/'.$brand->id)}}" class="btn btn-danger">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"> Add Brand </div>
                        <div class="card-body">
                            <form action="{{ route('addBrand') }}" method="POST" enctype="multipart/form-data"> 
                                @csrf 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Brand Name</label>
                                    <input type="text" class="form-control" id="brandname" name="brand_name" aria-describedby="emailHelp">

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

                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

     
        </div>
    </div>
</x-app-layout>