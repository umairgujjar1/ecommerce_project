


@extends('Admin.Layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href=" {{ route('admin.sub-category.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        @include('Admin.message')
        <!-- Default box -->
        <form action="{{ route('admin.sub_category.update') }}" method="POST">
            @csrf
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name">Category</label>
                                    <select name="category" id="category" class="form-control">
                                        @if ($categories->isNotEmpty())
                                            @foreach ($categories as $category)
                                                <option @if (!empty($sub_categories)) @if ($sub_categories->category_id == $category->id) selected
                                                @endif @endif value="{{ $category->id }}">{{ $category->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" value="@if(!empty($sub_categories)){{$sub_categories->name}}@endif"
                                        class="form-control  @error('name')
                                is-invalid
                            @enderror"
                                        placeholder="Name">
                                    @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Slug</label>
                                    <input type="text"   name="slug" id="slug" value="@if(!empty($sub_categories)){{$sub_categories->slug}}@endif"
                                     class="form-control"
                                        placeholder="Slug">
                                    <p></p>
                                </div>
                                <input type="hidden" name="sub_category_id" value="{{$sub_categories->id}}">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status"  id="status" class="form-control">
                                        <option {{($sub_categories->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                        <option  {{($sub_categories->status == 2) ? 'selected' : '' }} value="2">Block</option>
                                    </select>
                                    <p>

                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Show on Home</label>
                                    <select name="showHome"  id="showHome" class="form-control">
                                        <option {{($sub_categories->showHome == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option  {{($sub_categories->showHome == 'No') ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                    <p>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{route('admin.sub-category.index')}}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
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
