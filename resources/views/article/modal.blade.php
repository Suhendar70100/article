<input type="hidden" id="id">

<div class="modal fade" id="addArticleButton" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
    <div class="modal-content p-3 p-md-5">
      <div class="modal-body p-md-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-4">
          <h3 class="mb-2 pb-1 title">Tambah Artikel Baru</h3>
        </div>
        <form id="addNewCCForm" class="row g-4" onsubmit="return false">
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input id="title" name="title" class="form-control credit-card-mask" type="text" placeholder="title" />
              <div class="invalid-feedback"></div>
              <label for="modalAddCard">Title</label>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <input id="image" name="image" class="form-control credit-card-mask" type="file" />
              <div class="invalid-feedback"></div>
            </div>
          </div>
          <div class="col-12">
            <div class="form-floating form-floating-outline">
              <textarea class="form-control h-px-100" id="content"
                placeholder="Comments here..."></textarea>
              <label for="content">Kontent</label>
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" id="submit-button" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <button type="reset" class="btn btn-outline-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>