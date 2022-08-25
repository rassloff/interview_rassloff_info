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
            <th>Question</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($questions as $question)
            <tr>
                <td>{{ $question->id }}</td>
                <td>{{ $question->question }}</td>
                <td>
                    <form action="{{ route('interviewQuestions.destroy',$question->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('interviewQuestions.show',$question->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('interviewQuestions.edit',$question->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

@endsection
