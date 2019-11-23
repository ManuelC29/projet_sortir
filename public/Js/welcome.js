// on cache la case de la liste des participants
$('.hidethis').hide();

// on programme un événement click sur chaque ligne de la liste des trips
// et on récupère ou l'on clique pour le tester et ne rien faire si c'est un lien a
$('.ligne').click(function(event){
    if (event.target.nodeName != "A"){
        sortirPanneau($(this).attr('id'));
    }
});

// Fonction qui toggle la liste des participants
function sortirPanneau(idrow){
                $( "#hidethis" + parseInt(idrow)).toggle("fast");
}
