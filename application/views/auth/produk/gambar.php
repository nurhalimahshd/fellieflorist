<form action="" id="formGambarProduk">
    <div class="modal-body">
        <div class="row">
            <?php foreach ($gambar as $gambar) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                    <div class="card">

                        <img class="card-img-top" src="<?= base_url('assets/img/upload/produk/thumb/cropped/' . $gambar->file) ?>" alt="Card image cap">
                        <div class="card-body text-center">
                            <div class="btn-group">
                                <?php if ($gambar->file == $produk->gambar) { ?>
                                    <a href="" class="btn btn-sm btn-secondary disabled"><i class="set fa fa-paper-plane"></i></a>
                                    <a href="" class="btn btn-sm btn-secondary disabled"><i class="fa fa-trash-alt"></i></a>
                                <?php } else { ?>
                                    <a onclick="set(<?= $gambar->id ?>)" class="btn btn-sm btn-primary"><i class="set fa fa-paper-plane"></i></a>
                                    <a onclick="hapus(<?= $gambar->id ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?= input_file('gambarProduk') ?>
    </div>

    <div class="modal-footer">
        <button type="submit" class="btn btn-primary "><i class="fa fa-paper-plane"></i> Submit</button>
    </div>
</form>

<script>
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function set(id) {
        let id_produk = '<?= $produk->id ?>';
        $.ajax({
            url: base_url + 'auth/gambar/set',
            type: 'post',
            dataType: 'json',
            data: {
                id: id,
                id_produk: id_produk
            },
            success: function(data) {
                console.log(data);

                Swal.fire({
                    icon: data.respond,
                    title: data.title,
                    html: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });

                if (data.respond == 'success') {
                    $('#isiTable').load(base_url + 'auth/produk/table');
                    $('#isiModalLg').load(base_url + 'auth/produk/gambar/' + id_produk);
                }

            }
        })
    }

    function hapus(id) {
        let id_produk = '<?= $produk->id ?>';
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'auth/gambar/hapus/' + id,
                    type: 'post',
                    dataType: 'json',
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

                            $('#isiModalLg').load(base_url + 'auth/produk/gambar/' + id_produk);
                        }
                    }
                });
            }
        });
    }

    $('form#formGambarProduk').submit(function(e) {
        e.preventDefault();

        let id = '<?= $produk->id ?>';

        Swal.fire({
            title: 'Please Wait !',
            html: 'Uploading file . . .',
            showConfirmButton: false,
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $.ajax({

            url: base_url + 'auth/upload/gambarproduk/' + id,
            type: 'post',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                Swal.fire({
                    icon: data.respond,
                    title: data.title,
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                if (data.respond == 'success') {
                    $('#isiTable').load(base_url + 'auth/produk/table');
                    $('#isiModalLg').load(base_url + 'auth/produk/gambar/' + id);
                }


            }
        })
    })
</script>