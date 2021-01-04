<div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Total Produk</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($kategori as $kategori) {
            ?>
                <tr>
                    <td><?= $no ?></td>
                    <td><?= $kategori->nama ?></td>
                    <td><?= $kategori->slug ?></td>
                    <td><?= count($this->kategori_model->get_produk($kategori->id)) ?></td>
                    <td>
                        <a onclick="edit(<?= $kategori->id ?>)" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                        <a onclick="hapus(<?= $kategori->id ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
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
        $('#isiModal').load(base_url + 'auth/kategori/h_edit/' + id);
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
                    url: base_url + 'auth/kategori/hapus/' + id,
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
                            $('#isiTable').load(base_url + 'auth/kategori/table');
                        }
                    }
                })
            }
        })


    }
</script>