<div class="card mb-3">
    <div class="card-header fw-bold">
        {{ $following->count() }} Following
    </div>
    <div class="card-body">
        @foreach ($following as $follower)
            <div class="row mb-3">
                <div class="col-md-2">
                    <a href="{{ route('user-info', $follower->userWhoFollow->username ) }}">
                        <img src="{{ asset('storage/images/'.$follower->userWhoFollow->avatar) }}"
                             class="card-img-top rounded-circle mx-auto"
                             alt="user-profile-image"
                             style="width: 50px; height: 50px; object-fit: cover;"
                        >
                    </a>
                </div>
                <div class="col-md-7">
                    <div>
                        <a href="{{ route('user-info', $follower->userWhoFollow->username ) }}" class="text-dark fw-bold text-decoration-none">
                            {{ $follower->userWhoFollow->name }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-info', $follower->userWhoFollow->username ) }}" class="text-secondary text-decoration-none">
                            {{ '@'.$follower->userWhoFollow->username }}
                            <span class="fst-italic" style="font-size: 11px;">
                            {{ $follower->userWhoFollow->isFollowing(Auth::user()) ? " ~ Follows you" : "" }}
                        </span>
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{route(Auth::user()->isFollowing($follower->userWhoFollow) ? "unfollow" : "follow", $follower->userWhoFollow->username)}}"
                       class="btn btn-sm {{ Auth::user()->isFollowing($follower->userWhoFollow) ? "btn-danger" : "btn-primary" }}">
                        {{ Auth::user()->isFollowing($follower->userWhoFollow) ? "Unfollow" : "Follow" }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
