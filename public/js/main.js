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
    console.log('hjjkh')
    if ($('#catID').val() != 0) {
        $('.cate').removeClass('selected');
        $('#' + $('#catID').val()).addClass('selected');


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
$('#search').on('input', function() {
    var query = $(this).val();
    var _token = $('#searching > input[name="_token"]').val();
    if (query) {
        $.ajax({
            method: "POST", // method
            url: "/search", // lien ou se trouve les donnees
            data: { query: query, _token: _token },
            success: function($rep) {
                $("#result").html($rep); // inner HTML

            },
            error: function($res) {

            }
        })
    } else {
        $("#result").html("");
    }
})

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
            nav: true,
            loop: false
        }
    }
})

$('.owl-carousel2').owlCarousel({
    loop: true,
    margin: 10,
    responsiveClass: true,
    responsive: {
        0: {
            items: 1,
            nav: true
        },
        600: {
            items: 2,
            nav: false
        },
        1000: {
            items: 4,
            nav: true,
            loop: false
        }
    }
})
$(document).on('click', '.pagination a', function(event) {
    event.preventDefault();

    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page);
});

function fetch_data(page) {
    console.log($('#catID').val())
    $.ajax({
        url: "/pagination/fetch_data/" + $('#catID').val() + "?page=" + page,
        success: function(data) {
            $('#produit').html(data);
        }
    });
}
