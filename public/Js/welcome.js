$('#resPlace').click(getApiStreet($('#resPlace').val()));

/////////////////////////////////////////////////////
//  Lancement de script une fois la page chargé    //
/////////////////////////////////////////////////////
$(document).ready(function (event) {
    getApiPlace($('#citySel').val());
    recherche();
});

/////////////////////////////////////////
//  Quand on change la valeur du lieu  //
/////////////////////////////////////////
$('#resPlace').change(function (event) {
    getApiStreet($('#resPlace').val());
});

/////////////////////////////////////////
//      Va chercher la street          //
/////////////////////////////////////////
function getApiStreet(idPlace) {
    $.ajax({
        url: 'http://sortir.local/street/' + idPlace,
        method: "GET"
    })
        .done(function (data, status, xhr) {
            try {
                // je récupère l'objet
                var obj = JSON.parse(data);

                $("#street").val(obj.street);

            } catch (error) {
                $("#resPlace").html("<option value=>Pas de lieu</option>");
                console.log("pas de donnée: " + error);
            }
        })
        .fail(function (xhr, status, errorThrown) {
            console.log('Erreur dans l\'intérogation de l\'API');
        });
}

//////////////////////////////////////////////////////////////////////////////////////////
// Fonction pour récupérer le Place quand on change la valeur de la liste déroulant     //
// qui a un id = citySel                                                                //
//////////////////////////////////////////////////////////////////////////////////////////
$('#citySel').change(function (event) {
    //appel de la fonction ajax
    getApiPlace($('#citySel').val());
    recherche();
});

////////////////////////////////////////////
// Fonction qui va chercher sur la route  //
// api les données  de la                 //
//  ville demandé envoyer en Json         //
////////////////////////////////////////////
function getApiPlace(idPlace) {
    $.ajax({
        url: 'http://sortir.local/api/' + idPlace,
        method: "GET"
    })
        .done(function (data, status, xhr) {
            // je récupère l'objet
            try {
                var obj = JSON.parse(data);

                var liste="";
                for (var i = 0; i < obj.length; i++) {
                    liste += "<option value=" + obj[i].id + ">" + obj[i].namePlace + "</option>"
                }
                    $("#resPlace").html(liste);
                    getApiStreet($('#resPlace').val());

            } catch (error) {
                $("#resPlace").html("<option value=>Pas de lieu</option>");
                console.log("pas de donnée: " + error);
            }
        })
        .fail(function (xhr, status, errorThrown) {
            console.log('Erreur dans l\'intérogation de l\'API');
        });
}

/////////////////////////////////////////////////////////////////////////
// fonction pour afficher la map en fonction de la ville sélectionner  //
/////////////////////////////////////////////////////////////////////////
function recherche() {
    //paramétrage d'entrée de la ville
    let ville = $('#citySel option:selected').text();

    // récupération dans l'API geo.gouv
    $.ajax({
        url: "https://api-adresse.data.gouv.fr/search/?q=" + ville,
        method: "GET"
    })
        .done(function (data, status, xhr) {

            initialiserMap();
            //console.log(data);
            try {
                             $('#street').val(data['features'][0]['properties']['label']);
                             $('#zip').val(data['features'][0]['properties']['postcode']);
                             $('#latitude').val(data['features'][0]['geometry']['coordinates'][0]);
                             $('#longitude').val(data['features'][0]['geometry']['coordinates'][1]);
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
/////////////////////////
// Réinitialise la map //
/////////////////////////
function initialiserMap() {
    var container = L.DomUtil.get('map');
    if (container != null) {
        container._leaflet_id = null;
    }
}

