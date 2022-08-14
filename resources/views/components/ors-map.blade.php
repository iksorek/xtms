<div id="map">
   TIME: {{$geo->start_time}}
    <script type="text/javascript">

        let long_from = {{$geo->long_from}};
        let lat_from = {{$geo->lat_from}};
        let long_to = {{$geo->long_to}};
        let lat_to = {{$geo->lat_to}};

        let map = L.map('map').setView([lat_from, long_from], 200);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);


        let request = new XMLHttpRequest();
        let answer;

        request.open('POST', "https://api.openrouteservice.org/v2/directions/driving-car/geojson");

        request.setRequestHeader('Accept', 'application/geo+json, application/gpx+xml, img/png; charset=utf-8');
        request.setRequestHeader('Content-Type', 'application/json');
        request.setRequestHeader('Authorization', '5b3ce3597851110001cf624854d525d126804b628205207273f97738');

        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                console.log('Body:', this.responseText);
                answer = (this.responseText);
                L.geoJSON(JSON.parse(answer)).addTo(map);
                map.fitBounds([
                    [lat_from, long_from],
                    [lat_to, long_to]
                ]);

            }
        };

        const body = '{"coordinates":[[{{$geo->long_from}},{{$geo->lat_from}}],[{{$geo->long_to}},{{$geo->lat_to}}]]}';

         request.send(body);



    </script>
</div>
