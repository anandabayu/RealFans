@foreach ($contents as $content)
<div class="card mb-3">
    <div class="card-body">
        <table>
            <tbody>
                <tr>
                    <th>
                        <a href="{{ route('user-info', $content->user->username ) }}">
                        <img src="{{ asset('storage/images/'.$content->user->avatar) }}"
                             class="card-img-top rounded-circle"
                             alt="user-profile-image"
                             style="width: 50px; height: 50px; object-fit: cover;"
                        >
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('user-info', $content->user->username ) }}" class="text-decoration-none">
                        <div class="ms-3">
                            <div class="text-dark fw-bold">{{ $content->user->name }}</div>
                            <div class="text-secondary">
                                {{ '@'.$content->user->username }}
                            </div>
                        </div>
                        </a>
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <img src="{{ asset('storage/images/' . $content->image) }}"
         class="card-img-top mx-auto"
         alt="profile-image"
         style="max-height: 250px; object-fit: cover; border-radius: 0px"
    >
    <div class="card-body">
        @if(!$content->isVisible())
            <div class="alert alert-danger">
                This content is locked, <a href="{{ route('subscribe', $content->user->username) }}" class="text-dark fw-bold fst-underline">subscribe</a> to see the content!
            </div>
        @endif

        {{$content->caption}}
    </div>
</div>
@endforeach
