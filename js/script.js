//init isotope
var $grid = $('.collections-list').isotope({
    // options
});
// filter items on button click
$('.filter-button-group').on('click', 'button', function() {

    var filterValue = $(this).attr('data-filter');

    resetFilterBtns();

    $(this).addClass('active-filter-btn');
    $grid.isotope({ filter: filterValue });
});


var $filterBtns = $('.filter-button-group').find('button');

function resetFilterBtns() {
    $filterBtns.each(function() {
        $(this).removeClass('active-filter-btn');
    });
}

// end of relative isotope

function _loadPayment() {
    $prix = localStorage.getItem('prix_panier');

    //document.querySelector('#card-price').innerHTML = $prix;
    total = $prix.replace('$', '');
    total = total.trim();
    amount_pay = parseFloat(total);
    amount_pay *= 620;
    amount_pay = Math.ceil(amount_pay);

    end = amount_pay + ' XAF';

    end = $prix + ' -> ' + end;

    document.querySelector('#card-price').innerHTML = end;
}