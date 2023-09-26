@extends('Admin.Layout.app')

@section('content')
    <style>
        .thumbnail {
            max-width: 100px;
            /* Adjust the maximum width of the thumbnail */
            max-height: 100px;
            /* Adjust the maximum height of the thumbnail */
            margin: 5px;
            /* Adjust the margin between thumbnails */
            border-radius: 10px;
        }
    </style>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('admin.product.store') }}" method="POST" id="productForm" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="hidden" name="product_id" value="">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control  @error('title')
                                                is-invalid
                                            @enderror"
                                                placeholder="Title" value="">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="title">Slug</label>
                                            <input type="text" readonly name="slug" id="slug"
                                                class="form-control @error('slug')
                                                    is-invalid
                                                @enderror"
                                                placeholder="Slug" value="">
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="short_description">Short Description</label>
                                            <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote"
                                            ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="10" class="summernote"
                                                placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="shipping_returns">Shipping And Returns</label>
                                            <textarea name="shipping_returns" id="shipping_returns" cols="30" rows="10" class="summernote"
                                                placeholder="shipping_returns"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <input type="file" name="images[]" id="imageUpload" multiple>
                                        </div>
                                        <div id="imagePreview"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- <div class="card mb-3">
                                <div class="card-body">
                                     <h2 class="h4 mb-3">Media</h2>
                                    <h2 class="h4 mb-3">Media</h2>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">
                                            <br>Drop files here or click to upload.<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Pricing</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" value="" id="price"
                                                class="form-control @error('price')
                                                    is-invalid
                                                @enderror"
                                                placeholder="Price">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="compare_price">Compare at Price</label>
                                            <input type="text" name="compare_price" id="compare_price" value=""
                                                class="form-control" placeholder="Compare Price">
                                            <p class="text-muted mt-3">
                                                To show a reduced price, move the product’s original price into Compare at
                                                price. Enter a lower value into Price.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Inventory</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="sku">SKU (Stock Keeping Unit)</label>
                                            <input type="text" name="sku" id="sku" class="form-control"
                                                value="" placeholder="sku">
                                            @error('sku')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="barcode">Barcode</label>
                                            <input type="text" name="barcode" id="barcode" class="form-control"
                                                value="" placeholder="Barcode">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <div class="custom-control custom-checkbox">
                                                <input type="hidden" name="track_qty" value="No">
                                                <input class="custom-control-input" type="checkbox" id="track_qty"
                                            name="track_qty"
                                                    value="Yes">
                                                <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <input type="number" min="0" name="qty" id="qty"
                                                value=""
                                                class="form-control @error('track_qty')
                                                    is-invalid
                                                @enderror"
                                                placeholder="Qty">
                                            @error('track_qty')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product status</h2>
                                <div class="mb-3">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active
                                        </option>
                                        <option value="0">Block
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h2 class="h4  mb-3">Product category</h2>
                                <div class="mb-3">
                                    <label for="category">Category</label>
                                    <select name="category" id="category"
                                        class="form-control @error('category')
                                        is-invalid
                                    @enderror">
                                        <option value="">Select Category</option>
                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <option
                                                    value="{{ $category->id}}">{{ $category->name }} </option>
                                            @endforeach
                                        @endif

                                    </select>
                                    @error('category')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="category">Sub category</label>

                                    <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="">Select Sub-Catgory</option>
                                        @if (!empty($sub_categories))
                                            @foreach ($sub_categories as $sub_category)
                                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}
                                                </option>
                                            @endforeach
                                        @endif


                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Product brand</h2>
                                <div class="mb-3">
                                    <select name="brand" id="brand" class="form-control">
                                        <option value="">Select Brand</option>
                                        @if (!empty($brands))
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h2 class="h4 mb-3">Featured product</h2>
                                <div class="mb-3">
                                    <select name="is_featured" id="is_featured"
                                        class="form-control @error('is_featured')
                                        is-invalid
                                    @enderror">
                                        <option   value="No">No
                                        </option>
                                        <option   value="Yes">
                                            Yes</option>
                                    </select>
                                    @error('is_featured')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('admin.product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection

@section('custom_js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageUpload = document.getElementById('image-upload');
            const imagePreviewContainer = document.getElementById('image-preview-container');

            imageUpload.addEventListener('change', function() {
                // Clear existing previews
                imagePreviewContainer.innerHTML = '';

                // Loop through selected files and display previews
                for (const file of imageUpload.files) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const imagePreview = document.createElement('img');
                        imagePreview.src = e.target.result;
                        imagePreview.className = 'preview-image';
                        imagePreviewContainer.appendChild(imagePreview);
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
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
    <script>
        Dropzone.autoDiscover = false;
        $(function() {
            // Summernote
            $('.summernote').summernote({
                height: '300px'
            });

            const dropzone = $("#image").dropzone({
                url: "{{ route('admin.product-image.create') }}",
                maxFiles: 10,
                addRemoveLinks: true,
                acceptedFiles: "image/jpeg,image/png,image/gif",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(file, response) {
                    $("#image_id").val(response.id);
                }
            });

        });


        $("#category").change(function() {
            var category_id = $(this).val();

            $.ajax({
                url: '{{ route('admin.products-subcategory.index') }}',
                type: 'get',
                data: {
                    category_id: category_id
                },
                dataType: 'json',
                success: function(response) {
                    $("#sub_category").find("option").not(":first").remove();
                    $.each(response["subCategories"], function(key, item) {
                        $("#sub_category").append(
                            `<option value='${item.id}'>${item.name}</option>`)
                    });
                },
                error: function() {
                    console.log('something went wrong');
                }
            });
        });

        // $("#productForm").submit(function(event){
        //     event.preventDefault();
        //     var formArray = $(this).serializeArray();
        //     $("button[type ='submit']").prop('disabled',true);
        //     $.ajax({
        //         url : '{{ route('admin.product.store') }}',
        //         type : 'post',
        //         data : formArray,
        //         dataType : 'json' ,
        //         success : function(response){
        //             $("button[type ='submit']").prop('disabled',false);
        //             if (response['status'] == true){

        //             }else{
        //                 var errors = response['errors'];
        //                 $(".errors").removeClass("inavlid-feedback").html("");
        //                 $("input[type = 'text'],select").removeClass("is-invalid");

        //                 $.each(errors,function(key,value){
        //                    $(`#${key}`).addClass('is-invalid')
        //                    .siblings('p').addClass('invalid-feedback')
        //                    .html(value );
        //                 })
        //             }
        //         },
        //         error: function(){
        //             console.log('something went wrog');
        //         }
        //     });

        // });
    </script>
    <script>
        document.getElementById("imageUpload").addEventListener("change", function(e) {
            const imagePreview = document.getElementById("imagePreview");
            imagePreview.innerHTML = "";

            const files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                if (file.type.match("image.*")) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        const img = document.createElement("img");
                        img.classList.add("thumbnail");
                        img.src = e.target.result;
                        imagePreview.appendChild(img);
                    };

                    // Read the file as a data URL and limit the size
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>
@endsection
