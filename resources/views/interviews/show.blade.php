@extends('interviews.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Interview</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('interviews.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Title:</strong>
                {{ $interview->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Text:</strong>
                {{ $interview->text }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created:</strong>
                {{ $interview->created_at }}
                @if ($interview->created_by)
                    by
                    {{ $interview->createdBy->name }}
                @endif
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Updated:</strong>
                {{ $interview->updated_at }}
                @if ($interview->updated_by)
                    by
                    {{ $interview->updatedBy->name }}
                @endif
            </div>
            <br>
            <a class="btn btn-primary" href="{{ url("interviewQuestion/".$interview->id."/") }}">
                add new Question to Interview
            </a>
        </div>

        <br>
        List of Questions:<br>
        <table>
        @foreach($interview->questions as $question)
            <tr>
                <td>{{$question->id}}</td>
                <td>{{$question->question}}</td>
                <td>
                    @foreach($interview->answers as $answer)
                        ???
                        @if($answer->question_id == $question->id)
                            {{$answer->answer}}
                        @else
                            <a class="btn btn-primary" href="{{ url("interviewAnswer/" . $interview->id . "/add/" . $question->id) }}">
                                add answer
                            </a>
                        @endif
                    @endforeach
                    @if($interview->answers->count() == 0)
                            <a class="btn btn-primary" href="{{ url("interviewAnswer/" . $interview->id . "/add/" . $question->id) }}">
                                add answer
                            </a>
                        @endif
                </td>
            </tr>
        @endforeach
        </table>
        - add an existing question - via select <br>

        <br>

    </div>
@endsection
