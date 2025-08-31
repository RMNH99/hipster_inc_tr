@extends('Layouts.adminlayout')
@section('content')

<div class="row col-sm-12">
    <form method="post" action="{{route('admin.store_product')}}" enctype="multipart/form-data">
        @csrf
        <div class="row col-sm-12">
            <div class="col-sm-3">
                <div class="form-group mt-3 col-sm-12">
                    <img src="{{ asset('storage/products/default_image.png')}}" alt="" id="preImg" class="mt-3" style="max-width:100%; min-width: 200px; min-height: 200px; border: 1px solid black; border-radius: 5px;">
                    <label for="exampleInputname1">Product Image</label>
                    <input type="file" name="prodImg" class="form-control" id="images" accept="image/*" onchange="imgPreview(event)">
                </div>
            </div>
            <div class="col-sm-9 row">
                <div class="form-group mt-3 col-sm-12">
                    <label for="exampleInputname1">Product Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                </div>
                <div class="form-group mt-3 col-sm-12">
                    <label for="exampleInputname1">Description</label>
                    <textarea rows="3" name="description" class="form-control" id="exampleTextarea"></textarea>
                </div>
                <div class="form-group mt-3 col-sm-4">
                    <label for="exampleInputname1">Category</label>
                    <input list="category" name="category" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                    <datalist id="category">
                        <option value=""></option>
                    </datalist>
                </div>
                <div class="form-group mt-3 col-sm-4">
                    <label for="exampleInputname1">Price</label>
                    <input type="text" name="price" class="form-control" oninput="this.value = this.value.replace(/[^0-9\.]/g,'')" id="exampleInputname1" aria-describedby="nameHelp">
                </div>
                <div class="form-group mt-3 col-sm-4">
                    <label for="exampleInputname1">Stock</label>
                    <input type="text" name="stock" class="form-control" id="exampleInputname1" aria-describedby="nameHelp">
                </div>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary mt-3 w-100 text-center">Add</button>
    </form>
</div>

@endsection
@push('script')
<script>
    function imgPreview(e){

        var reader = new FileReader();
        reader.onload = function()
        {
            var preview = document.getElementById('preImg');
            preview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush