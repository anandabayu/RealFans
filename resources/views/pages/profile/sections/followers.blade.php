<div class="card mb-3">
    <div class="card-header fw-bold">
       {{ $followers->count() }} Followers
    </div>
    <div class="card-body">
        @foreach ($followers as $follower)
            <div class="row mb-3">
                <div class="col-md-2">
                    <a href="{{ route('user-info', $follower->userToFollow->username ) }}">
                        <img src="{{ asset('storage/images/'.$follower->userToFollow->avatar) }}"
                             class="card-img-top rounded-circle mx-auto"
                             alt="user-profile-image"
                             style="width: 50px; height: 50px; object-fit: cover;"
                        >
                    </a>
                </div>
                <div class="col-md-7">
                    <div>
                        <a href="{{ route('user-info', $follower->userToFollow->username ) }}" class="text-dark fw-bold text-decoration-none">
                            {{ $follower->userToFollow->name }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('user-info', $follower->userToFollow->username ) }}" class="text-secondary text-decoration-none">
                            {{ '@'.$follower->userToFollow->username }}
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <a href="{{route(Auth::user()->isFollowing($follower->userToFollow) ? "unfollow" : "follow", $follower->userToFollow->username)}}"
                       class="btn btn-sm {{ Auth::user()->isFollowing($follower->userToFollow) ? "btn-danger" : "btn-primary" }}">
                        {{ Auth::user()->isFollowing($follower->userToFollow) ? "Unfollow" : "Follow" }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
