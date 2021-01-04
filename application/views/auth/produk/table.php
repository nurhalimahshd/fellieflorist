<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($produk as $produk) {
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><a href="#" onclick="gambar(<?= $produk->id ?>)"><img src="<?= base_url('assets/img/upload/'.$produk->gambar) ?>"  class=" img-fluid img-thumbnail" width="150px" alt=""></a></td>
                    <td><?= $produk->nama ?></td>
                    <td><?= $produk->kategori ?></td>
                    <td><?= $produk->harga ?></td>
                    <td><?= $produk->status ?></td>
                    <td>
                        <a onclick="edit(<?= $produk->id ?>)" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a onclick="hapus(<?= $produk->id ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
            <?php }
            $no++; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    })

    function edit(id) {
        $('#isiModal').load(base_url + 'auth/produk/h_edit/' + id);
        $('#modal').modal('show');
    }

    function hapus(id) {

        Swal.fire({
            title: 'Hapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: base_url + 'auth/produk/hapus/' + id,
                    type: 'post',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: data.respond,
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        if (data.respond == 'success') {
                            $('#isiTable').load(base_url + 'auth/produk/table');
                        }
                    }
                })
            }
        })
    }

    function gambar(id)
    {
        alert(id);
    }
</script>