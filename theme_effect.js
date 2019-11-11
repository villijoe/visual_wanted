/**
 * Created by Orion on 21.02.2017.
 */

$( document ).ready(function() {
    $( ".catalog" ).on('click', function(e){
        $( ".catalog" ).css("background-color", "white");
        $( this ).css("background-color", "green");
        $( this ).after( "<span class='ui-button-icon ui-icon ui-icon-plusthick add-theme'></span>" );

        $( ".add-theme" ).button().on( "click", function(e) {
            dialog.dialog( "open" );
            catalog = this.id;
            console.log(catalog);
        });
    });
});
