<div id="map">
    <script type="text/javascript">

        let long_from = {{$geo->long_from}};
        let lat_from = {{$geo->lat_from}};
        let long_to = {{$geo->long_to}};
        let lat_to = {{$geo->lat_to}};

        let map = L.map('map').setView([lat_from, long_from], 200);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        fetch('https://api.openrouteservice.org/v2/directions/driving-car/geojson', {
            method: 'POST',
            headers: {
                'Accept': 'application/geo+json, application/gpx+xml, img/png; charset=utf-8',
                'Content-Type': 'application/json',
                'Authorization': '5b3ce3597851110001cf624854d525d126804b628205207273f97738'
            },
            body: '{"coordinates":[[{{$geo->long_from}},{{$geo->lat_from}}],[{{$geo->long_to}},{{$geo->lat_to}}]]}'
        }).then(response => response.json())
            .then(data => {
                L.geoJSON(data).addTo(map);
                map.fitBounds([
                    [lat_from, long_from],
                    [lat_to, long_to]
                ]);
            }).catch(error => console.error('Error:', error));


    </script>
</div>
