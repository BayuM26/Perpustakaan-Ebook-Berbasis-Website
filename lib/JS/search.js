$(document).ready(function() {
    $('#searchAdmin').on('keyup', function() {
        $.ajax({
            type: 'POST',
            url: '../class/pustakawan.php',
            data: {
                searchDataAdmin: $(this).val()
            },
            cache: false,
            success: function(data) {
                $('#tampilAdmin').html(data);
            }
        });
    });
});

$(document).ready(function() {
    $('#searchEbook').on('keyup', function() {
        $.ajax({
            type: 'POST',
            url: '../class/ebook.php',
            data: {
                searchDataEbook: $(this).val()
            },
            cache: false,
            success: function(data) {
                $('#tampilEbook').html(data);
            }
        });
    });
});

$(document).ready(function() {
    $('#searchbook').on('keyup', function() {
        $.ajax({
            type: 'POST',
            url: 'class/ebook.php',
            data: {
                searchEbook: $(this).val()
            },
            cache: false,
            success: function(data) {
                $('#tampilbook').html(data);
            }
        });
    });
});

$(document).ready(function() {
    $('#searchpengunjung').on('keyup', function() {
        $.ajax({
            type: 'POST',
            url: 'class/pengunjung.php',
            data: {
                searcPengunjung: $(this).val()
            },
            cache: false,
            success: function(data) {
                $('#tampilpengunjung').html(data);
            }
        });
    });
});

