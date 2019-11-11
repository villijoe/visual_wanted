/**
 * Created by Orion on 21.02.2017.
 */
$(document).ready( function() {

    var dialog, form,
        name = $( "#name" ),
        description = $( "#description" ),
        img = $( "#img" ),
        price = $( "#price" ),
        link = $( "#link" ),
        catalog;

    function checkLength( o, n, min, max ) {
        if ( o.val().length > max || o.val().length < min ) {
            o.addClass( "ui-state-error" );
            updateTips( "Length of " + n + " must be between " +
                min + " and " + max + "." );
            return false;
        } else {
            return true;
        }
    }

    function checkRegexp( o, regexp, n ) {
        if ( !( regexp.test( o.val() ) ) ) {
            o.addClass( "ui-state-error" );
            updateTips( n );
            return false;
        } else {
            return true;
        }
    }



    function addWant(){
        var valid = true;

        valid = valid && checkLength( name, "wanted", 2, 255 );
        valid = valid && checkLength( description, "description", 5, 5000 );
        valid = valid && checkLength( img, "photo", 5, 255 );
        valid = valid && checkLength( price, "price", 1, 7 );
        valid = valid && checkLength( link, "link", 5, 1000 );

        valid = valid && checkRegexp( name, /^[a-zA-Z\u0400-\u04FF]([0-9a-zA-Z-\u0400-\u04FF_\s])+$/i, "" );
        valid = valid && checkRegexp( description, /^[a-zA-Z\u0400-\u04FF]([0-9a-zA-Z-,."\u0400-\u04FF_\s])+$/i, "" );
        valid = valid && checkRegexp( img, /(https?:\/\/.*\.(?:png|jpg))/i, "" );
        valid = valid && checkRegexp( price, /^\d+(,\d{1,2})?$/i, "" );
        valid = valid && checkRegexp( link, /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i, "" );

        if ( valid ) {
            $.ajax({
                method: "POST",
                url: "add_want.php",
                data: { name: name.val(), description: description.val(), img: img.val(), price: price.val(), link: link.val(), catalog: catalog }
            }).done( function( response ) {
                console.log(response);
                dialog.dialog("close");
            });

        }
    }

    dialog = $( "#dialog-form" ).dialog({
        autoOpen: false,
        height: 450,
        width: 350,
        modal: true,
        buttons: {
            "Add wanted": addWant,
            Cancel: function() {
                dialog.dialog( "close" );
            }
        },
        close: function() {
            form[ 0 ].reset();
            //allFields.removeClass( "ui-state-error" );
        }
    });

    form = dialog.find( "form" ).on( "submit", function( event ) {
        event.preventDefault();
        addWant();
    });

    $( ".catalog" ).on('click', function(e){
        var list = $( "#list div" );
        catalog = $( this ).attr('id');
        list.remove();
        $( ".catalog" ).css("background-color", "white");
        $( ".add-theme" ).remove();
        $( this ).css("background-color", "green");
        $( this ).after( "<span class='ui-button-icon ui-icon ui-icon-plusthick add-theme'></span>" );
        getListTheme(catalog);

        $( ".add-theme" ).on( "click", function(e) {
            dialog.dialog( "open" );
            console.log(catalog);
        });
    });

    function activeCatalog(){
        
    }

    function getListTheme(catId){
        $.ajax({
            method: "POST",
            url: "get_list_theme.php",
            data: { catalogId: catId }
        }).done( function( response ) {
            //console.log(response);
            //console.log(catId);
            showListTheme( response );
        });
    }

    function showListTheme(response){
        var data = jQuery.parseJSON(response),
            list = $( "#list" );
        console.log(list);
        $.each(data, function(){
            list.append(
                "<div class='list-theme'>" + "<a href='" + this.link + "'>"
                + "<img src='"
                + this.img + "' height='200px' width='300px' />" + "</a>"
                + "<h1>"
                + this.name
                + "</h1>"
                + "<h2>"
                + this.price
                + "</h2>"
                + "</div>" );
        });
        //console.log(data[0].name+','+data[0].img);
    }
});
