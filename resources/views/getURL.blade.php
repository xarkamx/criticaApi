
<?php
    echo file_get_contents("http://".$_GET['url']);
?>
<body data-csrf_token={{csrf_token()}}>
    <script src="/js/main/helpers.js"></script>
    <script src="/js/main/ajax.js"></script>
    <script src="/js/main/templates.js"></script>
    <script src="/js/main/dom.js"></script>
    <script src="/js/main/tools.js"></script>
    <script>
        function getPlaces(country){
            let places=document.querySelectorAll('.map-container a');
            let sites=[];
            for(let index=0;index<places.length;++index){
                let place=places[index];
                let data={};
                data.url=place.href;
                data.place=place.classList[1];
                data.country=country;
                sites.push(data);
            }
            document.body.innerHTML='';
            return sites;
        }
        new Tools().ajax.postData("/api/places/bulk",{
            places:JSON.stringify(getPlaces('MEX')),
            _token:document.body.dataset.csrf_token
        },(ev)=>{
            console.log(ev);
        },'post');
    </script>
</body>