<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Event</title>
        <link rel="stylesheet" href="css/main.css" />
        <link rel="stylesheet" href="css/template/event.css" />
        <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css" />
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="semantic/dist/semantic.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                function getQueryParams() {

                    var queryRaw = document.location.search.split('?');
                    if (!queryRaw.length) {
                        return false;
                    }
                    var query = queryRaw[1].split('&');
                    var params = {};
                    for(var i=0; i<query.length; i++) {
                        var tokens = query[i].split('=');
                        params[decodeURIComponent(tokens[0])] = decodeURIComponent(tokens[1]);
                    }
                    return params;
                }

                var getParameters = getQueryParams();
                if (!getParameters || typeof getParameters['id'] === "undefined") {
                    alert('wrong hole');

                }
                else {
                    load(getParameters['id']);
                }
                function load(id) {
                    $.ajax({
                        url : 'http://flashevents.flash-global.net/backend/api/events' + '/' + id,
                        dataType : 'json'
                    }).success(function(result) {
                        var event = result[0];
                        if (event.picture || false) {
                            $("#picture").attr('src', event.picture);
                            $("#picture").attr('alt', event.name || event.description);
                            $("#picture").show();
                        }

                        if (event.eventLink || false) {
                            $("#link").attr('href', event.eventLink);
                            $("#link").text(event.eventLink);
                            $("#link").removeClass('hidden');
                        }

                        if (result.address || false) {
                            $("#address").text(result.address.streetName);
                            $("#address").removeClass('hidden');
                        }

                        if (result.startDate || false) {
                            $("#hourStart").text(event.startDate.data);//todo format date
                            $("#hourStart").removeClass('hidden');
                        }

                        if (result.description || false) {
                            $("#description").text(event.description);
                            $("#description").removeClass('hidden');
                        }

                    }).fail(function(result) {
                        alert('FATAL ERROR @lav');//dédicace var_dump//dédicace c'est gênant
                    }).done(function(result){

                    });
                }
            });

        </script>
    </head>
    <body>
        <div class="ui container grid centered">
            <div class="">
                <img id="picture" class="hidden ui image fluid" src="" alt="" style="max-width:480px;"/>
            </div>
            <div class="ui list">
                <div class="item">
                    <i class="marker icon"></i>
                    <div class="content hidden" id="address">
                        27 Rue Philippe II,<br/>
                        L-2340 Luxembourg<br/>
                        Luxembourg
                    </div>
                </div>
                <div class="item">
                    <i class="wait icon"></i>
                    <div class="content hidden">
                        2017-03-12 18:00
                    </div>
                </div>
                <div class="item">
                    <i class="street view icon"></i>
                    <div id="dist" class="hidden content">
                        6 km
                    </div>
                </div>
                <div class="item">
                    <i class="linkify icon"></i>
                    <div class="content">
                        <a id="link" class="hidden" href="//city.snooze.pub">city.snooze.pub</a>
                    </div>
                </div>
            </div>
            <div id="description" class="hidden">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Maecenas tempus lectus id urna porttitor, ut aliquam nulla mattis.
                Phasellus eu suscipit sapien. Donec vel commodo neque,
                ac blandit dolor.
            </div>
        </div>
    </body>
</html>