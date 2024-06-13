<div class="card">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:80px" class="me-3 avatar-sm rounded-circle"
                                    @if($idea->user->image) src="{{ asset($idea->user->image)}}" @else
                                    src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi" @endif
                                     alt="Mario Avatar"><div>
                    <h5 class="card-title mb-0"><a href="{{ route('users.show', $idea->user->id) }}"> {{ $idea->user->name }}
                        </a></h5>
                </div>

            </div>
            <div>
                <form action="{{ route('idea.destroy', $idea->id) }}" method="post">
                    @csrf
                    @method('delete')
                    @if(auth()->id() == $idea->user_id)
                    <a style="text-decoration: none;" class="mx-2" href="{{ route('idea.edit', $idea->id) }}">edit</a>
                    @endif
                    <a style="text-decoration: none;" class="mx-2" href="{{ route('idea.show', $idea->id) }}">view</a>
                    @if(auth()->id() == $idea->user_id)
                    <button class="ms-1 btn btn-danger btn-sm">x</button>
                    @endif


                </form>




            </div>

        </div>
    </div>
    <div class="card-body">
        @if ($editing ?? false)
        <form action="{{ route('idea.update', $idea->id) }}" method="post">
        @csrf
        @method('put')
        <div class="mb-3">
            <textarea class="form-control" name="content" id="idea" rows="3">{{ $idea->content }}</textarea>
            @error('content')
            <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>

            @enderror
        </div>
        <div class="">
            <button type="submit" class="btn btn-dark mb-2"> Edit </button>
        </div>

    </form>


        @else
        <p class="fs-6 fw-light text-muted">
            {{ $idea->content }}
        </p>

        @endif

        <div class="d-flex justify-content-between">
            <div>
                <a  href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                    </span> {{ $idea->likes }} </a>
            </div>
            <div>
                <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                {{ $idea->created_at }}</span>
            </div>
        </div>
        @include('shared.comment-box')
    </div>
</div>
