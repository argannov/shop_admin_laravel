 $(document).ready(function(){
        $("#checkboxbanners").change(function(){
            if ($(this).attr("checked")) {
                $('#imagesbanner').toggleClass('hidden');
                return;
            } else {
                $('#imagesbanner').toggleClass('hidden');
            }

        });
        $('.checkboxDelivery').change(function(){
            $('input[name="' + $(this).attr('name') +'"]').removeAttr('checked');
            $(this).prop('checked', true);
        });
        $('.checkboxPay').change(function(){
                    $('input[name="' + $(this).attr('name') +'"]').removeAttr('checked');
                    $(this).prop('checked', true);
                });
                $('.order-success').delay(3000).fadeOut();
});


