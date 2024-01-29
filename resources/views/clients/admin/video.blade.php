@extends('layouts.admin')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Video
        </div>
        <div class="card-body">
            <div class="text-right">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus"></i> Add Video</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <form method="POST" action="{{ route('videos.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name="title" class="form-control" placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Link Youtube</label>
                                        <input type="text" name="content" class="form-control" placeholder="Link Youtube">
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
                    <th>Title</th>
                    <th>Link Youtube</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>System Architect</td>
                    <td><a href="https://www.youtube.com">https://www.youtube.com</a></td>
                    <td>
                        <<button class="btn btn-warning" data-toggle="modal" data-target="#editModal-{{1}}"><i class="bi bi-pencil-square"></i></button>

                        <!-- Modal -->
                        <div class="modal fade" id="editModal-{{1}}" tabindex="-1" role="dialog" aria-labelledby="editModal-{{1}}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Video</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <form method="POST" action="{{ route('videos.store') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Title</label>
                                                <input type="text" name="title" class="form-control" placeholder="Title">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Link Youtube</label>
                                                <input type="text" name="content" class="form-control" placeholder="Link Youtube">
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
                        <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
