 <button class="btn btn-primary btn-sm" aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-create-post"
     data-overlay="#modal-create-post">
     Buat
     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
         class="size-5">
         <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
     </svg>
 </button>
 <div id="modal-create-post" class="overlay modal overlay-open:opacity-100 hidden" role="dialog" tabindex="-1">
     <div class="modal-dialog overlay-open:opacity-100 w-96">
         <div class="modal-content">
             <div class="modal-header">
                 <h3 class="modal-title">Buat Post</h3>
                 <button type="button" class="btn btn-text btn-cir72cle btn-sm absolute end-3 top-3" aria-label="Close"
                     data-overlay="#modal-create-post">
                     <span class="icon-[tabler--x] size-4"></span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="post" id="create-post-form"
                     enctype="multipart/form-data">
                     @csrf
                     <div class="w-full flex justify-center">
                         <img id="image-create-post-preview" alt="preview" width="200" class="text-center"
                             style="display:none">
                     </div>
                     <label class="form-control max-w-sm">
                         <div class="label">
                             <span class="label-text">Upload Gambar</span>
                         </div>
                         <input type="file" class="input" name="image"
                             onchange="loadFile(event, 'image-create-post-preview')" />
                     </label>

                     <label class="form-control max-w-sm">
                         <div class="label">
                             <span class="label-text">Masukkan judul</span>
                         </div>
                         <input type="text" placeholder="Judul post" class="input" name="title" />
                     </label>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-soft btn-secondary"
                     data-overlay="#modal-create-post">Close</button>
                 <button type="submit" class="btn btn-primary" form="create-post-form">Save changes</button>
             </div>
         </div>
     </div>
 </div>
 <script>
     document.addEventListener('DOMContentLoaded', () => {
         window.HSStaticMethods.autoInit();
         const {
             element
         } = window.HSOverlay.getInstance('#modal-create-post', true);
         element.on('close', instance => {
             document.getElementById('create-post-form').reset();
             document.getElementById('image-create-post-preview').style.display = 'none';
         });
     });

     function loadFile(event, elID) {
         let image = document.getElementById(elID);
         image.src = URL.createObjectURL(event.target.files[0]);
         image.style.display = 'block';
     };
 </script>
