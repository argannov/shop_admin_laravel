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

     // обработчик удаления
     var $deleteBtn = $('.delete-btn');
     $deleteBtn && $deleteBtn.on('click', function () {
         if (!confirm('Вы уверены, что хохите удалить?')) {
             return;
         }

         $.ajax({
             type: 'POST',
             url: $(this).data('route'),
             data: {
                 "_token": csrfToken
             },
             success: function (data) {
                 window.location.reload();
             }
         });
     });

     //обработчик формы поиска в админке
     var $searchForm = $('.sidebar-form');
     $searchForm && $searchForm.on('submit', function (event) {
         event.preventDefault();
         var $this = $(this);
         var text = $this.serializeArray()[0].value; //параметр поиска
         window.location = $this.attr('action') + '/' + text;
     });

});


