@extends('Admin.Layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href=" {{route('admin.category.index')}}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->


        <div class="container-fluid">
            <div class="card">
                <form action="{{ route('admin.category.update')}}" method="POST" id="categoryForm" name="categoryForm">
                    @csrf
                    <div class="card-body">
                        @include('Admin.message')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" value="{{$categories->id}}" name="id">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="{{$categories->name}}"
                                        class="form-control
                                    @error('name')
                                        is-invalid
                                    @enderror"
                                        placeholder="Name">
                                </div>
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror

                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly name="slug" value="{{$categories->slug}}" id="slug" class="form-control  @error('name')
                                    is-invalid
                                @enderror "
                                        placeholder="Slug">
                                </div>
                                @error('slug')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ ($categories->status == 1) ? 'selected' :'' }} value="1">Active</option>
                                        <option {{ ($categories->status == 2) ? 'selected' :'' }} value="2">Block</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">show On Home</label>
                                    <select name="showHome" id="showHome" class="form-control">
                                        <option {{ ($categories->showHome == 'Yes') ? 'selected' :'' }} value="Yes">Yes</option>
                                        <option {{ ($categories->showHome == 'No') ? 'selected' :'' }} value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="pb-5 pt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{route('admin.category.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
            </div>
            </form>
        </div>
        {{-- @endforeach

        @endif --}}
        <!-- /.card -->
    </section>
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
