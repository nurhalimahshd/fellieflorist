<?= form_open('produk') ?>
<div class="modal-body">
    <?= input_text('nama', '', 'Nama Produk', 'trail-sign') ?>
    <div class="form-group">
        <label for="kategori">
            <ion-icon name="list"></ion-icon> Kategori
        </label>
        <select class="form-control" name="kategori" id="kategori">
            <?php foreach ($kategori as $kategori) { ?>
                <option value="<?= $kategori->id ?>"><?= $kategori->nama ?></option>
            <?php } ?>
        </select>
    </div>
    <?= input_text('kode', '', 'Kode Produk', 'barcode') ?>
    <?= input_textarea('deskripsi', '', 'Deskripsi Produk', 'chatbubble-ellipses') ?>
    <?= input_text('harga', '', 'Harga Produk', 'pricetag') ?>
    <div class="form-group">
        <label for="status">
            <ion-icon name="eye"></ion-icon> Status Produk
        </label>
        <select class="form-control" name="status" id="status">
                <option value="1">Publikasikan</option>
                <option value="2">Simpan sebagai Draft</option>
        </select>
    </div>
    <?= input_text('keyword', '', 'Keyword Produk', 'at-circle') ?>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
</div>
</form>

<script>
    CKEDITOR.replace('deskripsi');
    $('form#produk').submit(function(e) {
        e.preventDefault();



        $.ajax({
            url: base_url + 'auth/produk/p_tambah',
            type: 'post',
            dataType: 'json',
            data: {
                id_kategori: $('select#kategori').val(),
                slug: '',
                nama: $('input#nama').val(),
                kode: $('input#kode').val(),
                deskripsi: $('textarea#deskripsi').val(),
                harga: $('input#harga').val(),
                gambar: 'default.png',
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