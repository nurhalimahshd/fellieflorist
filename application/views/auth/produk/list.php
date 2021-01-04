<div class="card">
    <div class="card-header">
        <a id="tambahProduk" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Produk</a>
    </div>
    <div class="card-body">
        <div id="isiTable">
            ...
        </div>
    </div>
</div>

<script>
    $('document').ready(function() {
        $('#isiTable').load(base_url + 'auth/produk/table');
    })

    $('a#tambahProduk').click(function(e) {
        e.preventDefault();
        $('#isiModal').load(base_url + 'auth/produk/h_tambah');
        $('#modal').modal('show');
    });
</script>