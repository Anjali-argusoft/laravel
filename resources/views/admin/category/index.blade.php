<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           All Category
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

                <div class="card-header"> All Category </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>SL NO</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Category name</th>
                        <th scope="col">Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($i = 1)
                    @foreach($categories as $category)
                    <tr>
                    <th>{{ $i++ }}</th>
                    <td>{{ $category->user_id }}</td>
                    <td>{{ $category->category_name }}</td>
                    @if($category->created_at == NULL)
                    <td> <span class="text-danger">No Date Set</span></td>
                    @else
                    <td>{{ $category->created_at->diffForHumans() }}</td>
                    @endif
                    </tr>
                    @endforeach
                    </tbody>
            </table>
         </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header"> Add Category </div>
                <div class="card-body">
                <form action="{{ route('addCategories') }}" method="POST">
                    @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Category Name</label>
                    <input type="text" class="form-control" id="categoryname" name="category_name" aria-describedby="emailHelp">
                   
                    @error('category_name')
                     <div class="text-danger">{{ $message }}</div>
                    @enderror
              
                </div>
               
                <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
                </div>
            </div>
        </div>
      </div>
     </div>
    </div>
</x-app-layout>
