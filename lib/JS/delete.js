$(document).on('click', '.btn_deleteAdmin', function(){

    var idAdmin = $(this).attr('id');
    if (confirm('Apakah anda yakin ingin menghapus ini')){
        $.ajax({
            type: 'POST',
            url: "../class/pustakawan.php",
            data: {DeleteAdmin:idAdmin},
            cache: false,
            success: function(data) {
                $('#tampilAdmin').html(data);
            }
        });
    }
});

$(document).on('click', '.btn_deleteEbook', function(){
    
        var idEbook = $(this).attr('id');
    if (confirm('Apakah anda yakin ingin menghapus ini')){
        $.ajax({
            type: 'POST',
            url: "../class/ebook.php",
            data: {DeleteEbook:idEbook},
            cache: false,
            success: function(data) {
                $('#tampilEbook').html(data);
            }
        });
    }
});

$(document).on('click', '.btn_deletepengunjung', function(){
    
    var idpengunjung = $(this).attr('id');
    if (confirm('Apakah anda yakin ingin menghapus ini')){
        $.ajax({
            type: 'POST',
            url: "../class/pengunjung.php",
            data: {Deletepengunjung:idpengunjung},
            cache: false,
            success: function(data) {
                $('#tampilpengunjung').html(data);
            }
        });
    }
});

$(document).on('click', '.btn_deleteAkunPengunjung', function(){
    
    var idhapusAkun = $(this).attr('id');
    if (confirm('Apakah anda yakin ingin menghapus akun ini?')){
        $.ajax({
            type: 'POST',
            url: "class/profile.php",
            data: {DeleteAkun:idhapusAkun},
            success: function() {
                Location.reload();
            }, error: function(response){
                console.log(response.responseText);
            }
        }); 
    }
});