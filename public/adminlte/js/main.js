(function ($) {
    "use strict";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.required').append(' <span class="red">(*)</span>');

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();


    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({ scrollTop: 0 }, 1500, 'easeInOutExpo');
        return false;
    });


    // Sidebar Toggler
    $('.sidebar-toggler').click(function () {
        $('.sidebar, .content').toggleClass("open");
        return false;
    });


    // Progress Bar
    $('.pg-bar').waypoint(function () {
        $('.progress .progress-bar').each(function () {
            $(this).css("width", $(this).attr("aria-valuenow") + '%');
        });
    }, { offset: '80%' });


    // Calender
    $('#calender').datetimepicker({
        inline: true,
        format: 'L'
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        items: 1,
        dots: true,
        loop: true,
        nav: false
    });

    $('#' + mn_selected).addClass('active').parents(".treeview").addClass('active');
    $('.active a:first').addClass('active');
    $('.active a:first').addClass('show');
    $('.active div:first').addClass('show');

    setTimeout(remove_alert, 5000);

    $('.close').click(function () {
        remove_alert();
        $('#deleteModal').modal('hide');
    });
    $('#close').click(function (){
        $('#deleteModal').modal('hide');
    });

    $("#checkAll").change(function () {
        $("input.checkItem:checkbox").prop('checked', $(this).prop("checked"));
    });

    $("#btn-delete-all").on("click", function () {
        var routes = $(this).data("routes");
        $('#form_modal_delete').attr('action', root + routes);
        var idArr = [];
        $("#table-main tbody tr td .checkItem").each(function () {
            if ($(this).is(':checked')) {
                idArr.push($(this).val());
            }
        });
        $('#del_modal_id').val(idArr.join(","));
        if (idArr.length > 0) {
            $('#deleteModal').modal('show');
        }
    });

    $('.upload_img').on('change', function (){
        let avatar = $('.upload_img').val();
        if (avatar != ''){
            let extensions = avatar.split('.').pop().toLowerCase();
            if ($.inArray(extensions, ['png', 'gif', 'jpeg', 'jpg']) == -1) {
                $('.upload_img_error').removeClass('d-none');
                $('#btn_save').attr('disabled', true)
            }else{
                $('.upload_img_error').addClass('d-none');
                $('#btn_save').attr('disabled', false)
            }
        }
    });

    $('.upload_imgs').on('change', function (){
        let image = $('.upload_imgs').val();
        if (image != ''){
            let extensions = image.split('.').pop().toLowerCase();
            if ($.inArray(extensions, ['png', 'jpeg', 'jpg']) == -1) {
                $('.upload_img_errors').removeClass('d-none');
                $('#btn_save').attr('disabled', true)
            }else{
                $('.upload_img_errors').addClass('d-none');
                $('#btn_save').attr('disabled', false)
            }
        }
    });

    $('.fileupload-exists').click(function (){
        $('.upload_img_error').addClass('d-none');
        $('#btn_save').attr('disabled', false)
    });


    $('.btn_del_img').click(function (){
        $('.image-box img').attr('src', '/images/default.jpg')
        $('#remove_img').val(1);
        $('#remove_logo').val(1);
    })

    $('.btn_del_img1').click(function (){
        $('.image-box1 img').attr('src', '/images/default.jpg')
        $('#remove_img1').val(1);
        $('#remove_favicon').val(1);
    })

    $('.btn_del_img2').click(function (){
        $('.image-box2 img').attr('src', '/images/default.jpg')
        $('#remove_thumbnail').val(1);
    })


    $('.choose_icon').click(function (){
        $('#remove_img1').val('');
    })

    $('.remove_icon').click(function (){
        $('#remove_img1').val(1);
    })

    $('.choose_image').click(function (){
        $('#remove_image').val('');
    })

    $('.remove_image').click(function (){
        $('#remove_image').val(1);
    })
})(jQuery);

function remove_alert() {
    $('#flash_message').fadeOut();
}
//check required image
function checkImageRequired(image)
{
    if(image){
        return false;
    }
    return true;
}
//check ckdeditor
function showErrorCkeditor(textarea, error){
    if(!textarea){
        error.show();
    }else{
        error.hide();
    }  
}
//show notification active
function showNotificationActive(message){
    $.notify.addStyle('success', {
        html:
        "<div class='mod-notice mod-notice-icon success'>"+
            "<span class='mod-notify-icon icon'><i class='fa fa-check icon' data-notify-text='icon'></i></span>"+
            "<div class='mod-notify-container'>"+
                "<span class='mod-notify-title' data-notify-text='title'></span>"+
                "<span class='mod-notify-content' data-notify-text = 'text'></span>"+
            "</div>"+
            "<a href='javascript:;' onclick='close()' class='mod-close-notice'><i class='fa fa-times' aria-hidden='true'></i></a>"+
        "</div>",
        classes: {
            base: {
                "font-weight": "normal",
                "background-color": "#f9f9f9",
                "border": "1px solid #eee",
                "border-radius": "3px",
                "position": "relative",
                "box-shadow": "0 2px 1px 0 rgba(0, 0, 0, 0.2)",
                "border-radius": "10px",
            },
            success: {
                "border-left": "5px solid #16a05d",
                "border-color": "#16a05d",
                "padding" : "25px 45px",
            },

        }
    });
    $.notify.defaults({
        autoHideDelay: 5000,
        globalPosition: "top right",
        style: "success"
    });
    $.notify({
        title: 'Success',
        text: message,
        icon: ""
    }, {
        className: "success",
    });
}

jQuery.each({
    // slideDown: genFx( "show" ),
    // slideUp: genFx( "hide" ),
    // slideToggle: genFx( "toggle" ),
    fadeIn: { opacity: "show" },
    fadeOut: { opacity: "hide" },
    // fadeToggle: { opacity: "toggle" }
}, function (name, props) {
    jQuery.fn[name] = function (speed, easing, callback) {
        return this.animate(props, speed, easing, callback);
    };
});

function deleteModal(id, routes) {
    $('#form_modal_delete').attr('action', root + routes);
    $('#del_modal_id').val(id);
    $('#deleteModal').modal('show');
}
