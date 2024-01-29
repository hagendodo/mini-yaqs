@extends('layouts.admin')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Quote
        </div>
        <div class="card-body">
            <div class="text-right">
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-plus"></i> Add Quote</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Quote</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body text-left">
                                <form method="POST" action="{{ route('quotes.store') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Author</label>
                                        <input type="text" name="author" class="form-control" placeholder="Author">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quote</label>
                                        <textarea rows="5" name="quote" class="form-control" placeholder="Quote"></textarea>
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
                    <th>Quote</th>
                    <th>Author</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($quotes as $quote)
                <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>System Architect</td>
                        <td>Test</td>
                        <td>
                            <button type="button" class="btn btn-warning"  data-toggle="modal" data-target="#editModal-{{1}}"><i class="bi bi-pencil-square"></i></button>
                            <div class="modal fade" id="editModal-{{1}}" tabindex="-1" role="dialog" aria-labelledby="#editModal-{{1}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Quote</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <form method="POST" action="{{ route('quotes.update', ['quote' => 's']) }}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Author</label>
                                                    <input type="text" class="form-control" placeholder="Author">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Quote</label>
                                                    <textarea rows="5" class="form-control" placeholder="Quote"></textarea>
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
                @endforeach
                @if(count($quotes)<=0)
                    <tr>
                        <td colspan="4">There is no data.</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
