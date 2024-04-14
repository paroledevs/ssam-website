<template>
	<div id="filters">
		<div class="selector" :id="`${filterName}_filter`">
			<select v-model="selected" @change="redirectWithFilter" v-if="isCollection && propToShow && propToUse">
				<option v-if="disabledOption" value="disabled" disabled>{{ disabledOption }}</option>
				<option :value="null">{{ allText || 'Todos' }}</option>
				<option v-for="(option, index) in options" :key="index" :value="option[propToUse]">
					{{ option[propToShow] }}
				</option>
			</select>

			<select v-model="selected" @change="redirectWithFilter" v-else-if="isCollection">
				<option v-if="disabledOption" :value="-1">{{ disabledOption }}</option>
				<option :value="null">{{ allText || 'Todos' }}</option>
				<option v-for="(option, name) in options" :key="name" :value="option">{{ name }}</option>
			</select>

			<select v-model="selected" @change="redirectWithFilter" v-else>
				<option v-if="disabledOption" :value="-1">{{ disabledOption }}</option>
				<option :value="null">{{ allText || 'Todos' }}</option>
				<option v-for="(option, name) in options" :key="name" :value="option">{{ name }}</option>
			</select>

			<i class="fa fa-caret-down" aria-hidden="true"></i>
		</div>

		<div class="selector" v-if="isDate">
			<input type="date" />
			<i class="fa fa-caret-down" aria-hidden="true"></i>
		</div>

		<button type="button" class="del" v-if="somethingSelected" @click="redirect(baseUrl)">Remover filtros</button>
	</div>
</template>

<script>
	export default {
		props: ['baseUrl', 'options', 'isCollection', 'propToShow', 'propToUse', 'filterName', 'initValue', 'allText', 'disabledOption', 'isDate'],

		data() {
			return {
				selected: null,
			};
		},

		computed: {
			somethingSelected() {
				return this.selected != -1 && this.selected != 'disabled';
			},
		},

		methods: {
			redirectWithFilter() {
				if (this.selected == 'disabled') {
					return false;
				}

				if (!this.selected) {
					this.redirect(this.baseUrl);
				} else {
					window.location = `${this.baseUrl}?${this.filterName}=${this.selected}`;
				}
			},
		},

		mounted() {
			if (this.disabledOption) {
				this.selected = -1;
			}

			if (this.initValue) {
				this.selected = this.initValue;
				if (this.selected != 'disabled') {
					this.listenGlobalEvent('showFilters');
				}
			}
		},
	};
</script>
