@extends('layouts.admin')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Quote Category
        </div>
        <div class="card-body">
            <div class="text-right">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus"></i> Add Quote Category</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Quote Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <form method="POST" action="{{ route('quote-categories.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <input type="text" name="name" class="form-control" placeholder="Category">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Quote Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quoteCategories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-warning d-inline" data-toggle="modal" data-target="#editModal-{{ $category->uuid }}"><i class="bi bi-pencil-square"></i></button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal-{{ $category->uuid }}" tabindex="-1" role="dialog" aria-labelledby="editModal-{{ $category->uuid }}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Quote Category</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form method="POST" action="{{ route('quote-categories.update', [$category->uuid]) }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Category</label>
                                                    <input type="text" name="name" class="form-control" value="{{  $category->name  }}" placeholder="Category">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form class="d-inline" method="POST" action="{{ route('quote-categories.destroy', [$category->uuid]) }}">
                                @csrf
                                @method('DELETE')
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
























