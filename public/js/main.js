function getProds(link, idCat) {
    console.log(link + '/' + idCat);

    $.get(link + '/' + idCat, function(resultat) {
        $('#prods').html(resultat);
    });
}
$('.cat').on('click', function() {
    $('.cat').removeClass('active');
    $(this).addClass('active');
})

function selected() {
    if ($('#catID').val() != 0) {
        $('.cat').removeClass('active');
        $('#' + $('#catID').val()).addClass('active');
        console.log('hhh')
    }

}


function addtocart(link) {
    $.get('http://127.0.0.1:8000/addcart/' + link + '/' + $('#qty').val(), function(resultat) {
        console.log(resultat);
        $('#msg').show();
        setTimeout(function() {
            $('#msg').hide();
        }, 4000);
    });
}
