@extends('interviews.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left"></div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('interviewQuestions.create') }}"> Create New Interview Question</a>
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
            <th>Answer</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($answers as $answer)
            <tr>
                <td>{{ $answer->id }}</td>
                <td>{{ $answer->answer }}</td>
                <td>
                    <form action="{{ route('interviewAnswers.destroy',$answer->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('interviewAnswers.show',$answer->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('interviewAnswers.edit',$answer->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
