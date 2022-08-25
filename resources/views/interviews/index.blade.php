@extends('interviews.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('interviews.create') }}"> Create New Interview</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($interviews as $interview)
            <tr>
                <td>{{ $interview->id }}</td>
                <td>{{ $interview->title }}</td>
                <td>
                    <form action="{{ route('interviews.destroy',$interview->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('interviews.show',$interview->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('interviews.edit',$interview->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    @if ( $interviews )

    @endif

@endsection
