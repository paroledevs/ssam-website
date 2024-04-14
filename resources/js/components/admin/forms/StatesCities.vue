<template>
    <div>

        <div class="input" v-if="showStates">
            <label>Estado</label>
            <select v-model="state" name="state">
                <option disabled selected :value="null">Selecciona un estado</option>
                <option v-for="(state, id) in states" :key="id" :value="id">{{ state }}</option>
            </select>
            <div class="focus"></div>
        </div>

        <div class="input" v-if="showCities">
            <label>Ciudad</label>
            <select name="city_id" v-model="city">
                <option disabled selected :value="null">Selecciona una ciudad</option>
                <option  v-for="(city, id) in cities" :key="id" :value="id">{{ city }}</option>
            </select>
            <div class="focus"></div>
        </div>

    </div>
</template>

<script>

    export default {

        props: ['states', 'showStates' ,'showCities', 'initState', 'initCity'],

        data () {
            return {
                state: this.initState,
                city: this.initCity,
                cities: [],
            }
        },

        watch: {
            initState (initState) {
                this.state = initState;
            },
            initCity (initCity) {
                this.city = initCity;
            },
            state (state) {
                if (this.showCities) {
                    this.updateCities();
                }
            }
        },

        methods: {
            async updateCities () {
                if (!_.isNull(this.state) && !_.isUndefined(this.state)) {
                    let cities = await axios.post(`/api/pluck/cities/${this.state}`);
                    this.cities = cities.data;
                }
            }
        },

        mounted () {
            if (this.showCities) {
                this.updateCities();
            }
        }

    }

</script>
