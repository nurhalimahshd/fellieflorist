<?= form_open('kategori') ?>
<div class="modal-body">
    <?= input_text('nama', '', 'Nama Kategori', 'trail-sign') ?>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
</div>
</form>

<script>
    $('form#kategori').submit(function(e){
        e.preventDefault();


        
        $.ajax({
            url: base_url + 'auth/kategori/p_tambah',
            type:'post',
            dataType:'json',
            data: {
                nama: $('input#nama').val()
            },
            success: function(data){
                console.log(data);
                Swal.fire({
                    icon: data.respond,
                    title: data.title,
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                if(data.respond == 'success'){
                    $('#modal').modal('hide');
                    $('#isiTable').load(base_url + 'auth/kategori/table');
                }
            }
        })
    })
</script>