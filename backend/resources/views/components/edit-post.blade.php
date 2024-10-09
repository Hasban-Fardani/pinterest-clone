<div id="modal-edit-post" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
    <div class="modal-dialog overlay-open:opacity-100 w-96">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="edit-post-modal-title">Edit Post</h3>
                <button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Close"
                    data-overlay="#modal-edit-post">
                    <span class="icon-[tabler--x] size-4"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('posts.store') }}" method="post" id="edit-post-form"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex justify-center">
                        <img id="image-edit-post-preview" alt="preview" width="200" class="text-center"
                            style="display:none">
                    </div>
                    <label class="form-control max-w-sm mb-3">
                        <div class="label">
                            <span class="label-text">Upload Gambar</span>
                        </div>
                        <input type="file" class="input" name="image"  onchange="loadFile(event, 'image-edit-post-preview')"/>
                    </label>

                    <label class="form-control max-w-sm">
                        <div class="label">
                            <span class="label-text">Masukkan judul</span>
                        </div>
                        <input type="text" placeholder="Judul post" class="input" name="title"
                            id="edit-post-title" />
                    </label>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-soft btn-secondary" data-overlay="#modal-edit-post">Close</button>
                <button type="submit" class="btn btn-primary" form="edit-post-form">Save changes</button>
            </div>
        </div>
    </div>
</div>
<script>
    function loadFile(event, elID) {
        let image = document.getElementById(elID);
        image.src = URL.createObjectURL(event.target.files[0]);
        image.style.display = 'block';
    };
</script>
