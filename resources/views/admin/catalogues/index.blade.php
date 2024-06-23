@extends('admin.layouts.master')

@section('title')
    Catalogues 
@endsection
 
@section('content')
<a href="{{ route('admin.catalogues.create') }}" class="btn btn-primary mb-3"> Create</a>
    <table>
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Cover</th>
            <th>Is Active</th>
            <th>Create_at</th>
            <th>Update_at</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($catalogues as $catalogue)
                <tr>
                    <td>{{ $catalogue->id }}</td>
                    <td>{{ $catalogue->name }}</td>
                    <td>
                        <img src="{{ Storage::url($catalogue->cover) }}" alt="" width="100px">
                        
                    </td>
                    <td>{!! $catalogue->is_active ? 
                    '<span class="badge bg-primary">YES</span>':'<span class="badge bg-danger">NO</span>'  !!}</td>
                    <td>{{ $catalogue->created_at }}</td>
                    <td>{{ $catalogue->updated_at }}</td>
                    <td class="inline-block  ">
                        <a href="{{ route('admin.catalogues.show', $catalogue->id) }}" class="btn btn-primary mb-3  ">Show</a>
                        <a href="{{ route('admin.catalogues.edit', $catalogue->id) }}" class="btn btn-warning mb-3  ">Edit</a>
                        <form action="{{ route('admin.catalogues.destroy', $catalogue->id) }}" method="POST">  
                            @csrf     
                            @method('DELETE')
                        <button type="submit"  class="btn btn-danger mb-3" onclick="return confirm('Do you wanna Delete')">
                          Delete
                        </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $catalogues->links() }}
@endsection