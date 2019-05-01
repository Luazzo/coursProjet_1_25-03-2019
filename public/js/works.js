
$(document).ready(function() {
    var offsetNmb = 6; //on ne prend pas les 6 premiers
    var nmb = 5; // on peut changer le nombre des works à retourner
    $('#noMore').hide();

    $('#moreWorks').on('click', function(event) {
        event.preventDefault(); //Clicking on a link, prevent the link from following the URL

        let url = $(this).attr('data-url'); //recupere la route : ex: /en/work/more ou /fr/travail/more

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
                //attache code HTML à <ul> avec les autres images
                $('#worksGallery').append(reponseSrv.content);
                offsetNmb += nmb; // pour la prochaine requete le nombre des works pas retournés augemente

                //si false - ça veut dire il n' y plus des images à retourner
                if(reponseSrv === false){
                    $('#moreWorks').hide();
                    $('#noMore').show();
                }

            },
            error: function() {
                window.alert("Problème durant la transaction...");
            }
        })
    });
});
