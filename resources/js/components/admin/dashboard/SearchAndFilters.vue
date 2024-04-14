<template>
	<div id="actionbar">
		<div id="title">
			<span>{{ title }}</span>
		</div>

		<div id="buttons">
			<button id="btn_search" @click="showSearch" :class="{ showed: showSearchInBar }">
				<i class="icon-search"></i>
			</button>

			<div id="busqueda" v-if="searchRoute" :class="{ wiped: activesearch }">
				<div class="input">
					<input type="text" @blur="showSearch" placeholder="SEARCH..." id="txt_busqueda" v-model="searchText" @keypress.enter="search" />
				</div>
			</div>

			<button id="btn_filters" @click="showFilters" :class="{ showed: showFiltersInBar, active: activefilters }">
				<i class="icon-params"></i>
			</button>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['title', 'searchRoute', 'initSearchText', 'onSpaMode'],

		data() {
			return {
				showFiltersInBar: true,
				showSearchInBar: true,
				activefilters: false,
				activesearch: false,
				searchText: this.initSearchText || '',
			};
		},

		methods: {
			showFilters() {
				if (!this.activefilters) {
					this.activefilters = true;
					document.getElementById('contentItems').classList.add('filters');
				} else {
					this.activefilters = false;
					document.getElementById('contentItems').classList.remove('filters');
				}
			},

			showSearch() {
				if (!this.activesearch) {
					this.activesearch = true;
					setTimeout(function () {
						document.getElementById('txt_busqueda').focus();
					}, 600);
				} else {
					this.activesearch = false;
				}
			},

			hideFilters() {
				this.showFiltersInBar = false;
			},

			hideSearch() {
				this.showSearchInBar = false;
			},

			search() {
				if (!this.onSpaMode) {
					this.requestViaForm(route(this.searchRoute, { q: this.searchText }), 'GET');
				}

				if (this.searchText?.length) {
					this.emitGlobalEvent('makeSpaSearch', { q: this.searchText });
				} else {
					this.emitGlobalEvent('clearSearch');
				}
			},
		},

		mounted() {
			if (this.initSearchText) {
				this.showSearch();
			}

			this.listenGlobalEvent('hideFilters', this.hideFilters);
			this.listenGlobalEvent('hideSearch', this.hideSearch);
			this.listenGlobalEvent('showFilters', this.showFilters);
		},
	};
</script>
