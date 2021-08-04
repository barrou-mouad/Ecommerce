function getProds(link, idCat) {
    console.log(link + '/' + idCat);

    $.get(link + '/' + idCat, function(resultat) {
        $('#prods').html(resultat);
    });
}
$('.cat').on('click', function() {
    $('.cat').removeClass('selected');
    $(this).addClass('selected');
})
$(document).on('load', function() {
    alert('helllo')

})

function getcategorie() {
    $.get('http://127.0.0.1:8000/getcategories', function(resultat) {
        $('#cat').html(resultat);
    });
}
