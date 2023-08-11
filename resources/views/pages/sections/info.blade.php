<div class="card mb-3">
    <a href="{{ route('user-info', Auth::user()->username ) }}" class="mx-auto">
    <img src="{{ asset('storage/images/'.Auth::user()->avatar) }}"
         class="card-img-top rounded-circle mt-2"
         alt="profile-image"
         style="width: 150px; height: 150px; object-fit: cover;"
    >
    </a>
    <div class="card-body">
        <a href="{{ route('user-info', Auth::user()->username ) }}" class="card-title mt-3 text-decoration-none">
            <h5>{{ Auth::user()->name }}</h5>
        </a>
        <a href="{{ route('user-info', Auth::user()->username ) }}" class="card-text text-decoration-none">
            <p class="card-text">{{ '@'.Auth::user()->username }}</p>
        </a>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{ route('followers') }}">
                <div class="row text-center">
                    <div class="col-md-6">
                        <span class="text-dark">{{ Auth::user()->following()->count() }}</span>
                        <span class="text-secondary">following</span>
                    </div>
                    <div class="col-md-6">
                        <span class="text-dark">{{ Auth::user()->follower()->count() }}</span>
                        <span class="text-secondary">followers</span>
                    </div>
                </div>
            </a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('profile') }}" class="nav-link text-dark">Profile</a>
        </li>
        <li class="list-group-item">
            <a href="{{ route('logout') }}" class="nav-link text-dark" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
            >Log out</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </li>
    </ul>
</div>
