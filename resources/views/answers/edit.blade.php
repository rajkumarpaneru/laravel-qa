@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h1>Edit answer</h1>
                        </div>
                        <hr>
                        <form action="{{route('questions.answers.update', [$question->id, $answer->id])}}"
                              method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                        <textarea class="form-control
{{$errors->has('body') ? 'is-invalid' : ''}}" rows="7" name="body">{{old('body', $answer->body)}}</textarea>
                                @if($errors->has('body'))
                                    <div class="invalid-feedback">
                                        <strong>{{$errors->first('body')}}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-lg btn-outline-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
