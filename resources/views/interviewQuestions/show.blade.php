@extends('interviewQuestions.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Interview Question </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('interviewQuestions.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Question:</strong>
                {{ $interviewQuestion->question }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Created:</strong>
                {{ $interviewQuestion->created_at }}
                @if ($interviewQuestion->created_by)
                    by
                    {{ $interviewQuestion->createdBy->firstname }}
                @endif
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Updated:</strong>
                {{ $interviewQuestion->updated_at }}
                @if ($interviewQuestion->updated_by)
                    by
                    {{ $interviewQuestion->updatedBy->firstname }}
                @endif
            </div>
        </div>
    </div>
@endsection
