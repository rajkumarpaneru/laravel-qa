<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h2>{{$answersCount. " " . Str::plural('Answer', $question->answers_count)}}</h2>
                </div>
                <hr>
                @include('layouts._messages')
                @foreach($answers as $answer)
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="This answer is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <span class="vote-count">123</span>
                            <a title="This answer is not useful" class="vote-down off"><i
                                    class="fas fa-caret-down fa-3x"></i> </a>
                            @can('accept', $answer)
                                <a title="Mark as best answer"
                                   class="{{$answer->status}} mt-2"
                                   onclick="event.preventDefault(); document.getElementById('accept-answer-{{$answer->id}}').submit();">
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                                <form id="accept-answer-{{$answer->id}}"
                                      action="{{route('answers.accept', $answer->id)}}"
                                      method="post" style="display: none">
                                    @csrf
                                </form>
                            @else
                                @if($answer->is_best)
                                    <a title="Marked as best answer"
                                       class="{{$answer->status}} mt-2">
                                        <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan

                        </div>
                        <div class="media-body">
                            {!! $answer->body !!}
                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        @can('update', $answer)
                                            <a href="{{route('questions.answers.edit', [$question->id, $answer->id])}}"
                                               class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan
                                        @can('delete', $answer)
                                            <form method="post" class="form-delete"
                                                  action="{{route('questions.answers.destroy', [$question->id, $answer->id])}}">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">Delete
                                                </button>
                                            </form>
                                        @endcan

                                    </div>
                                </div>
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <span class="text-muted"> Answered {{$answer->created_date}}</span>
                                    <div class="media">
                                        <a href="{{$answer->user->url}}" class="pr-2">
                                            <img src="{{$answer->user->avatar}}">
                                            {{--                                                <img src="https://www.gravatar.com/avatar/{{md5(strtolower(trim('raj@mail.com')))}}?s=32">--}}
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
