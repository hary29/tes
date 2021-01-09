// modal
$(document).on('click', ".modalMd", function (event) {
    var title = $(this).attr('title');
    var target = $(this).attr('page');
    $.ajax({
        type: 'GET',
        url: APP_URL+'/'+target,
        dataType: 'HTML',

        success: function (data) {

        },
    }).then(data => {
        $('#myModalContent').html(data);
        $('#myModalTitle').html(title);
        $('#myModal').modal("show");
    })
    .catch(error => {
        var xhr = $.ajax();
        console.log(xhr);
        console.log(error);
    })
});

$(document).on('click', "#btnDonation", function (event) {
    $('html, body').animate({
        scrollTop: $("#transType").offset().top
    }, 2000);
});