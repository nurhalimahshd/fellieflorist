<div class="modal-header">
    <h5 class="modal-title"><?= $title ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<?php if ($content) {
    $this->load->view($content);
} ?>