var x = 1;

function cek(){
    $.ajax({
        url: "web/ceknotif.php",
        cache: false,
        success: function(msg){
            $("#waitingpasien").html(msg);
        }
    });
    var waktu = setTimeout("cek()",3000);
}

$(document).ready(function(){
    cek();
});


