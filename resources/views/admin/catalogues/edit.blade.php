@extends ('admin.layouts.master');

@section('title')
Catalogue Edit {{ $catalogue->name }}
@endsection

@section('content')
<form action="{{ route('admin.catalogues.update',$catalogue->id) }}" method="POST"  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="name" class="form-control " id="name" placeholder="Enter name" name="name" value="{{ $catalogue->name }}">
            </div>
            <div class="mb-3 mt-3">
                <label for="cover" class="form-label">File:</label>
                <input type="file" class="form-control" id="cover"  name="cover">
                <img src="{{ Storage::url($catalogue->cover) }}" alt="" width="100px">
            </div>
            <div class="form-check mb-3">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox" value="1" name="is_active" 
                  @if ($catalogue->is_active)checked @endif> Is_Active
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection