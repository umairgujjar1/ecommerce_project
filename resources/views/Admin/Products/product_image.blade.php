@extends('Admin.Layout.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$productId}}</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href=" {{ route('admin.sub-category.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
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
