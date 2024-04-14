<template>

    <div class="mapa" id="map">
    </div>

</template>

<script>
    import { initMap } from '@/helpers';

    export default {

        methods: {
            ...initMap,
            
        },

        mounted () {
            this.initMap();
        }

    }

</script>