<div class="card mb-3">
    <form action="{{ route('change-avatar') }}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <div class="card-header fw-bold">
            Change Avatar
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Choose Avatar</label>
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
                     style="display:none; width: 150px; height: 150px; object-fit: cover;"/>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Save</button>
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
