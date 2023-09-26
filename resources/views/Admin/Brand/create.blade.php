@extends('Admin.Layout.app')

@section('content')
 <!-- Main content -->
 <section class="content">
    <!-- Default box -->
    <form action="{{route('admin.brand.store')}}" method="post">
        @csrf
    <div class="container-fluid">

        <div class="card">
            <div class="card-body">
                @include('Admin.message')
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email">Slug</label>
                            <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Slug">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Block</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pb-5 pt-3">
            <button class="btn btn-primary">Create</button>
            <a href="{{route('admin.brand.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
        </div>
    </div>
</form>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('custom_js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const titleInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('input', function() {
            const titleValue = titleInput.value;
            const slugValue = generateSlug(titleValue);
            slugInput.value = slugValue;
        });

        function generateSlug(text) {
            return text
                .toLowerCase()
                .replace(/ /g, '-')
                .replace(/[^\w-]+/g, '');
        }
    });
</script>

@endsection
