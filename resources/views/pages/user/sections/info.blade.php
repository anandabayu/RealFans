<div class="card mb-3">
    <img src="{{ asset('storage/images/'.$user->avatar) }}"
         class="card-img-top rounded-circle mx-auto mt-2"
         alt="profile-image"
         style="width: 150px; height: 150px; object-fit: cover;"
    >
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <h5 class="card-title mt-3">{{ $user->name }}</h5>
            </div>
            @if(Auth::user()->id != $user->id)
            <div class="col-md-5 text-end">
                <a href="{{route(Auth::user()->isFollowing($user) ? "unfollow" : "follow", $user->username)}}"
                   class="btn btn-sm {{ Auth::user()->isFollowing($user) ? "btn-danger" : "btn-primary" }}">
                    {{ Auth::user()->isFollowing($user) ? "Unfollow" : "Follow" }}
                </a>

                <a href="{{ Auth::user()->isSubscribe($user) ? "#" : route("subscribe", $user->username)}}"
                   class="btn btn-sm {{ Auth::user()->isSubscribe($user) ? "btn-success" : "btn-primary" }}">
                    {{ Auth::user()->isSubscribe($user) ? "You already Subscribed" : "Subscribe" }}
                </a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
                <p class="card-text">
                    {{ '@'.$user->username }}
                    <span class="fst-italic" style="font-size: 11px;">
                        {{ $user->isFollowing(Auth::user()) ? " ~ Follows you" : "" }}
                    </span>
                </p>
            </div>
            <div class="col-md-6 text-end">
                @if(Auth::user()->isSubscribe($user))
                    Subscription ends on: {{ Auth::user()->getSubscriptionEndDate($user) }}
                @endif
            </div>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="row text-center">
                <div class="col-md-6">
                    <span class="text-dark">{{ $user->following()->count() }}</span>
                    <span class="text-secondary">following</span>
                </div>
                <div class="col-md-6">
                    <span class="text-dark">{{ $user->follower()->count() }}</span>
                    <span class="text-secondary">followers</span>
                </div>
            </div>
        </li>
    </ul>
</div>
