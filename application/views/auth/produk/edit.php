<?= form_open('produk') ?>
<div class="modal-body">
    <?= input_text('nama', $produk->nama, 'Nama Produk', 'trail-sign') ?>
    <div class="form-group">
        <label for="kategori">
            <ion-icon name="list"></ion-icon> Kategori
        </label>
        <select class="form-control" name="kategori" id="kategori" value="<?= $produk->id_kategori ?>">
            <?php foreach ($kategori as $kategori) { ?>
                <option value="<?= $kategori->id ?>"><?= $kategori->nama ?></option>
            <?php } ?>
        </select>
    </div>
    <?= input_text('kode', $produk->kode, 'Kode Produk', 'barcode') ?>
    <?= input_textarea('deskripsi', $produk->deskripsi, 'Deskripsi Produk', 'chatbubble-ellipses') ?>
    <?= input_number('harga', $produk->harga, 'Harga Produk', 'pricetag', 'Hanya masukkan angka') ?>

    <div class="form-group">
        <label for="status">
            <ion-icon name="eye"></ion-icon> Status Produk
        </label>
        <select class="form-control" name="status" id="status" value="<?= $produk->status ?>">
            <option value="1">Publikasikan</option>
            <option value="2">Simpan sebagai Draft</option>
        </select>
    </div>
    <?= input_text('keyword', $produk->keyword, 'Keyword Produk', 'at-circle') ?>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Update</button>
</div>
</form>

<script>
    $('document').ready(function() {
        $('textarea').summernote();
    })

    $('form#produk').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: base_url + 'auth/produk/p_edit/' + <?= $produk->id ?>,
            type: 'post',
            dataType: 'json',
            data: {
                id_kategori: $('select#kategori').val(),
                slug: 'default',
                nama: $('input#nama').val(),
                kode: $('input#kode').val(),
                deskripsi: $('textarea#deskripsi').val(),
                harga: $('input#harga').val(),
                status: $('select#status').val(),
                keyword: $('input#keyword').val(),

            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    icon: data.respond,
                    title: data.title,
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                if (data.respond == 'success') {
                    $('#modal').modal('hide');
                    $('#isiTable').load(base_url + 'auth/produk/table');
                }
            }
        })
    })
</script>