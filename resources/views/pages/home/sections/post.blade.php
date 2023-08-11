<div class="card mb-3">
    <form action="{{ route('post') }}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="card-header fw-bold">
            Post your content now!
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Choose Image</label>
                <div class="col-sm-9">
                    <input type="file"
                           class="form-control @error('image') is-invalid @enderror"
                           name="image"
                           id="selectImage"
                           accept="image/*">
                </div>
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <img id="preview"
                     src="#"
                     class="mt-3 mx-auto"
                     alt="choose-avatar"
                     style="display:none; width: 100%; height: 150px; object-fit: cover;"/>
            </div>

            <div class="row p-2">
                <textarea
                    itemid="caption"
                    name="caption"
                    class="form-control @error('caption') is-invalid @enderror"
                    id="caption"
                    maxlength="255"
                    placeholder="Write your caption here"
                    rows="3"
                >{{ old('caption') }}</textarea>
                @if ($errors->has('caption'))
                    <span class="text-danger">{{ $errors->first('caption') }}</span>
                @endif
            </div>

            <div class="row p-2">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_checked" name="is_checked">
                    <label class="form-check-label" for="is_checked">Locked (Subscriber only)</label>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Post</button>
        </div>
    </form>
</div>

@push('script')
    <script>
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
