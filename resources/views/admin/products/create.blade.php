@extends('admin.layouts.master')

@section('title')
    Product Create
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Product Create</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Products</a></li>
                        <li class="breadcrumb-item active">Product Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{-- Information --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Product Information</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                                <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    {{-- Name --}}
                                    <div class="mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    {{-- Sku --}}
                                    <div class="mt-3">
                                        <label for="sku" class="form-label">Sku</label>
                                        <input type="text" class="form-control" id="sku" name="sku"
                                            value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                    {{-- Img_thumbnail --}}
                                    <div class="mt-3">
                                        <label for="img_thumbnail" class="form-label">Img_thumbnail</label>
                                        <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
                                    </div>
                                    {{-- Img_thumbnail --}}
                                    <div class="mt-3">
                                        <label for="price_regular" class="form-label">Price_regular</label>
                                        <input type="number" value="0" class="form-control" id="price_regular"
                                            name="price_regular" value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                    {{-- Img_thumbnail --}}
                                    <div class="mt-3">
                                        <label for="price_sale" class="form-label">Price_sale</label>
                                        <input type="number" value="0" class="form-control" id="price_sale"
                                            name="price_sale" value="{{ strtoupper(\Str::random(8)) }}">
                                    </div>
                                    {{-- Catalogue --}}
                                    <div class="mt-3">
                                        <label for="catalogues_id" class="form-label">Catalogues</label>
                                        <select class="form-select" id="catalogues_id" name="catalogues_id">
                                            @foreach ($catalogues as $id => $name)
                                                <option value="{{ $id }}">
                                                    {{ $name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!--end col-->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="mt-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="description" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="material" class="form-label">Material</label>
                                            <textarea class="form-control" name="material" id="material" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="user_manual" class="form-label">User_manual</label>
                                            <textarea class="form-control" name="user_manual" id="user_manual" rows="2"></textarea>
                                        </div>
                                        <div class="mt-3">
                                            <label for="content" class="form-label">Content</label>
                                            <textarea class="form-control" name="content" id="content" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-secondary">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="is_active" name="is_active" checked>
                                                <label class="form-check-label" for="is_active">Is Active</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="is_hot_deal" name="is_hot_deal"checked>
                                                <label class="form-check-label" for="is_hot_deal">Is Hot Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-warning">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="is_good_deal" name="is_good_deal"checked>
                                                <label class="form-check-label" for="is_good_deal">Is Good Deal</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-info">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="is_new" name="is_new"checked>
                                                <label class="form-check-label" for="is_new">Is New</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-check form-switch form-switch-dark">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                    id="is_show_home" name="is_show_home"checked>
                                                <label class="form-check-label" for="is_show_home">Is Show Home</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </div>

                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        {{-- Variants --}}
        <div class="row" style="height:300px; overflow:scroll">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Product Variants</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                                <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Quantity</th>
                                            <th>Image</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sizes as $sizeID => $sizeName)
                                            @foreach ($colors as $colorID => $colorName)
                                                <tr>
                                                    <td>{{ $sizeName }}</td>
                                                    <td>
                                                        <div
                                                            style="width:50px ; height:50px; background:{{ $colorName }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" value="100"
                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][quantity]">
                                                    </td>
                                                    <td>
                                                        <input type="file" class="form-control"
                                                            name="product_variants[{{ $sizeID . '-' . $colorID }}][image]">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <td></td>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        {{-- Gallery --}}
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Gallery</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                                <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">

                                    <div class="mt-3">
                                        <label for="gallery_1" class="form-label">Gallery 1</label>
                                        <input type="file" class="form-control" id="gallery_1"
                                            name="product_galleries[]">
                                    </div>

                                    <div class="mt-3">
                                        <label for="gallery_22" class="form-label">Gallery 2</label>
                                        <input type="file" class="form-control" id="gallery_2"
                                            name="product_galleries[]">
                                    </div>
                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        {{-- Tag --}}
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Tags</h4>
                        <div class="flex-shrink-0">
                            <div class="form-check form-switch form-switch-right form-switch-md">
                                <label for="form-grid-showcode" class="form-label text-muted">Show Code</label>
                                <input class="form-check-input code-switcher" type="checkbox" id="form-grid-showcode">
                            </div>
                        </div>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-12">

                                    <div>
                                        <label for="tags" class="form-label">Tags</label>
                                        <select class="form-select" id="tags" name="tags[]" multiple>
                                            @foreach ($tags as $tagID => $tagName)
                                                <option value="{{ $tagID }}">{{ $tagName }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <!--end row-->
                            </div>

                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
        {{-- Submit --}}
        <div class="row">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center  d-flex  m-auto">

                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </form>
@endsection

@section('script-libs')
    <script src="//cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
@endsection
@section('scripts')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
