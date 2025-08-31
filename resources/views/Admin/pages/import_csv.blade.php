@extends('Layouts.adminlayout')
@section('content')

<div class="row col-sm-12">
    <form method="post" action="{{route('admin.store_imported_product')}}" enctype="multipart/form-data">
        @csrf

                <div class="form-group mt-3 col-sm-12">
            
                    <label for="exampleInputname1">Product Image</label>
                    <input type="file" name="file" class="form-control" accept=".csv">
                </div>

        
        <button type="submit" class="btn btn-primary mt-3 w-100 text-center">Upload</button>
    </form>
</div>

@endsection
