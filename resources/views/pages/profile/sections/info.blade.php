<div class="card mb-3">
    <form action="{{ route('change-info') }}"
          method="post">
        @csrf
        <div class="card-header fw-bold">
            Change Info
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly />
                </div>
            </div>

            <div class="row mb-3">
                <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ Auth::user()->name }}" />
                </div>
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <div class="row mb-3">
                <label for="username" class="col-sm-3 col-form-label">Username</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ Auth::user()->username }}" />
                </div>
                @if ($errors->has('username'))
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                @endif
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>
</div>
