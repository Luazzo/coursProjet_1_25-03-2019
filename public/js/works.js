
$(document).ready(function() {
    var offsetNmb = 6; //on ne prend pas les 6 premiers
    var nmb = 1; // nombre des works à retourner

    $('#moreWorks').on('click', function(event) {
        event.preventDefault(); //Clicking on a link, prevent the link from following the URL

        var url = $(this).attr('data-url'); //recupere la route : ex: /en/work/more ou /fr/travail/more

        $.ajax({
            url: url,
            method: 'POST',
            dataType: 'json',
            data: {
                offsetNmb: offsetNmb,
                vue: 'ajoutWorks',
                nmb: nmb
            },
            success: function (reponseSrv) {

                    /*$('#worksGallery').append(reponseSrv.html);
                    offsetNmb += nmb; // pour la prochaine requete le nombre des works pas retournés augemente*/
                    console.log(reponseSrv);


            },
            error: function() {
                window.alert("Problème durant la transaction...");
            }
        })
    });
});
/*
$(document).ready(function(){

    $('#show_more').click(function(){
        var btn_more = $(this);
        var count_show = parseInt($(this).attr('count_show'));
        var count_add  = $(this).attr('count_add');
        btn_more.val('Подождите...');

        $.ajax({
            url: "ajax.php", // куда отправляем
            type: "post", // метод передачи
            dataType: "json", // тип передачи данных
            data: { // что отправляем
                "count_show":   count_show,
                "count_add":    count_add
            },
            // после получения ответа сервера
            success: function(data){
                if(data.result == "success"){
                    $('#content').append(data.html);
                    btn_more.val('Показать еще');
                    btn_more.attr('count_show', (count_show+3));
                }else{
                    btn_more.val('Больше нечего показывать');
                }
            }
        });
    });

}); */