<div class="card">
    <div class="card-header fw-bold">
        Who to follow
    </div>
    <div class="card-body">
        @foreach ($whoToFollow as $user)
            <div class="row mb-3">
                <div class="col-md-2">
                    <a href="{{ route('user-info', $user->username ) }}">
                    <img src="{{ asset('storage/images/'.$user->avatar) }}"
                         class="card-img-top rounded-circle mx-auto"
                         alt="user-profile-image"
                         style="width: 50px; height: 50px; object-fit: cover;"
                    >
                    </a>
                </div>
                <div class="col-md-7">
                    <div>
                        <a href="{{ route('user-info', $user->username ) }}" class="text-dark fw-bold text-decoration-none">
                            {{ $user->name }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-info', $user->username ) }}" class="text-secondary text-decoration-none">
                        {{ '@'.$user->username }}
                        <span class="fst-italic" style="font-size: 11px;">
                            {{ $user->isFollowing(Auth::user()) ? " ~ Follows you" : "" }}
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{route(Auth::user()->isFollowing($user) ? "unfollow" : "follow", $user->username)}}"
                       class="btn btn-sm {{ Auth::user()->isFollowing($user) ? "btn-danger" : "btn-primary" }}">
                        {{ Auth::user()->isFollowing($user) ? "Unfollow" : "Follow" }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
