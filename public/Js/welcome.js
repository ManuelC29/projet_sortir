// on cache la case de la liste des participants
$('.hidethis').hide();

// on programme un événement click sur chaque ligne de la liste des trips
// et on récupère ou l'on clique pour le tester et ne rien faire si c'est un lien a
$('.ligne').click(function (event) {
    if ((event.target.nodeName !== "A") && (event.target.nodeName !== "BUTTON")) {
        sortirPanneau($(this).attr('id'));
    }
});

// Fonction qui toggle la liste des participants
function sortirPanneau(idrow) {
    $("#hidethis" + parseInt(idrow)).toggle("fast");
}


// Fonction pour récupérer le Place quand on change la valeur de la liste déroulant
// qui a un id = citySel
$('#citySel').change(function (event) {
    //suppression de toutes les options du select
    //$('#resPlace option').each(function(){
    //      $(this).remove();
    //});
    //appel de la fonction ajax
    getApiPlace($('#citySel').val());
    recherche();
});

// Fonction qui va chercher sur la route api les données envoyer en Json
function getApiPlace(idPlace) {
    // console.log(idPlace);
    $.ajax({
        url: 'http://sortir.local/api/' + idPlace,
        method: "GET"
    })
        .done(function (data, status, xhr) {
            // je récupère l'objet
            try {


                var obj = JSON.parse(data);
                $("#resPlace").html("<option value=" + obj.id + ">" + obj.namePlace + "</option>");


                //Pour tester
                //console.log(obj.id);
                //console.log(obj.namePlace);
            } catch (error) {
                $("#resPlace").html("<option value=>Pas de lieu</option>");
                console.log("pas de donnée: " + error);
            }
        })
        .fail(function (xhr, status, errorThrown) {
            console.log('Erreur dans l\'intérogation de l\'API');
        });

}

// fonction pour afficher la map en fonction de la ville sélectionner
function recherche() {
    //paramétrage d'entrée de la ville
    let ville = $('#citySel option:selected').text();
    console.log(ville);

    // récupération dans l'API geo.gouv
    $.ajax({
        url: "https://api-adresse.data.gouv.fr/search/?q=" + ville,
        method: "GET"
    })
        .done(function (data, status, xhr) {

            initialiserMap();
            //console.log(data);
            try {
                /*                $('#div1').text(data['features'][0]['properties']['id']);
                                $('#div2').text(data['features'][0]['properties']['label']);
                                $('#div3').text(data['features'][0]['properties']['postcode']);
                                $('#div4').text(data['features'][0]['properties']['population']);*/
               // console.log(data['features'][0]['geometry']['coordinates'][0]);
               // console.log(data['features'][0]['geometry']['coordinates'][1]);

                             $('#latitude').val(data['features'][0]['geometry']['coordinates'][0]);
                             $('#longitude').val(data['features'][0]['geometry']['coordinates'][1]);

                               /* $('#div7').text(data['features'][0]['properties']['context']);*/

                //ajout map
                let map = L.map('map').setView([data['features'][0]['geometry']['coordinates'][1], data['features'][0]['geometry']['coordinates'][0]], 10);

                // création du calque images
                let Esri_DeLorme = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/Specialty/DeLorme_World_Base_Map/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Tiles &copy; Esri &mdash; Copyright: &copy;2012 DeLorme',
                    minZoom: 1,
                    maxZoom: 12
                });

                Esri_DeLorme.addTo(map);

                // ajout d'un markeur
                let marker = L.marker([data['features'][0]['geometry']['coordinates'][1], data['features'][0]['geometry']['coordinates'][0]]).addTo(map);

                // ajout d'un popup
                marker.bindPopup('<h5>' + ville + '</h5>');

            } catch (error) {
                console.log("pas de ville : " + error);
            }
        })
        .fail(function (xhr, status, errorThrown) {
            console.log('Erreur dans l\'intérogation de l\'API');
        });

}

//réinitialise la map
function initialiserMap() {
    var container = L.DomUtil.get('map');
    if (container != null) {
        container._leaflet_id = null;
    }
}

