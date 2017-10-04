class Plugins{
    chosen(dom,emptyTxt="Oops, nothing found!"){
        $(dom).chosen({no_results_text: emptyTxt});
    }
    datepicker(dom){
        $(dom).datepicker({
            format:'mm/dd/yyyy'
        });
    }
    googleMapsAutoComplete(dom){
        let direcciones=new google.maps.places.
            Autocomplete(dom,{types:['geocode']});
    }
    printGoogleMap(position,dom,data){
        let map=new google.maps.Map(dom,{
            zoom:11,
            center:position,
            mapTypeId: 'hybrid',
            disableDefaultUI: true
        });
        let marker=new google.maps.Marker({
            position:position,
            map,
            title:data.titulo
        })
    }
    geoCoder(address,dom,data){
        let geocoder=new google.maps.Geocoder()
        geocoder.geocode( { 'address': address},(results, status)=> {
          if (status == google.maps.GeocoderStatus.OK) {
            this.printGoogleMap(results[0].geometry.location,dom,data);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
    });
    }
}