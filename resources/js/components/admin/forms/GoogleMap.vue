<template>

    <div class="mapa" id="map">
        <input type="hidden" name="lat" v-model="lat">
        <input type="hidden" name="lng" v-model="lng">
    </div>

</template>

<script>

    export default {

        props: {
            addressToLocate: String,
            initialLat: [String, Number],
            initialLng: [String, Number],
            markerTitle: String,
        },

        data () {
            return {
                map: null,
                lat: parseFloat(this.initialLat) || 20.6810184,
                lng: parseFloat(this.initialLng) ||-103.3589256,
                marker: null
            }
        },

        watch: {

            addressToLocate () {
                this.locateAddress();
                this.lat = this.map.getCenter().lat();
                this.lng = this.map.getCenter().lng();
            },

        },

        computed: {

            location () {
                return {
                    lat: this.lat,
                    lng: this.lng
                }
            }

        },

        methods: {
            initMap () {
                this.map = new google.maps.Map(document.querySelector('#map'), {
                    zoom: 13,
                    center: this.location,
                    zoomControl: true,
                    mapTypeControl: false,
                    scaleControl: true,
                    streetViewControl: false,
                    rotateControl: false,
                    fullscreenControl: false

                });

                this.marker = new google.maps.Marker({
                    position: this.location,
                    draggable: true,
                    animation: google.maps.Animation.BOUNCE
                });

                this.marker.setMap(this.map);
            },

            moveMarker (location) {
                this.marker.setPosition(location);
                this.map.setZoom(18);
            },

            locateAddress () {
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({ address: this.addressToLocate }, (results, status) => {

                    if (status === google.maps.GeocoderStatus.OK) {
                        this.map.setCenter(results[0].geometry.location);
                        this.moveMarker(results[0].geometry.location);
                    }

                });
            },
        },

        mounted () {
            this.initMap();
            this.moveMarker(this.location);

            google.maps.event.addListener(this.marker, 'dragend', () => {
                let position = this.marker.getPosition();
                this.lat = position.lat();
                this.lng = position.lng();
                this.map.setCenter(position);
            });
        }

    }

</script>