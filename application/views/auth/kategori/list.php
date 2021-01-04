<div class="card">
    <div class="card-header">
        <a id="tambahKategori" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
    </div>
    <div class="card-body">
        <div id="isiTable">
            ...
        </div>
    </div>
</div>

<script>
    $('document').ready(function() {
        $('#isiTable').load(base_url + 'auth/kategori/table');
    })

    $('a#tambahKategori').click(function(e) {
        e.preventDefault();
        $('#isiModal').load(base_url + 'auth/kategori/h_tambah');
        $('#modal').modal('show');
    });
</script>