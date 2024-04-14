<template>
	<div class="content">
		<div :class="`item ${itemClass}_item new`" @click="create">
			<label>Add product</label>
		</div>

		<div :class="`item ${itemClass}_item`" @click="edit(product)" v-for="product in items" :key="product.id">
			<div class="foto contain" :style="imgBackground(product.cover)"></div>
			<div class="texto">
				<strong>{{ product.title }}</strong>
				<span>{{ product.productable.title }}</span>
			</div>
		</div>

		<div :class="`item ${itemClass}_item more`" v-if="loadmore" @click="refresh(page)">
			<label>Load more</label>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			routes: {
				default: () => {
					return {};
				},
			},
			itemClass: {
				default: '',
			},
		},
		data() {
			return {
				resource: {},
				onSearchMode: false,
				searchText: '',
			};
		},
		computed: {
			items() {
				return this.resource.data || [];
			},
			links() {
				return this.resource.links || {};
			},
			meta() {
				return this.resource.meta || {};
			},
			loadmore() {
				return this.meta.total > this.meta.per_page && this.meta.to < this.meta.total;
			},
			page() {
				return this.loadmore ? this.meta.current_page + 1 : null;
			},
		},
		methods: {
			async refresh(page = null) {
				if (this.onSearchMode) {
					var resource = await window.axios.get(`${this.routes.index}?q=${this.searchText}${page ? '&page=' + page : ''}`);
				} else {
					var resource = await window.axios.get(`${this.routes.index}${page ? '?page=' + page : ''}`);
				}

				if (page) {
					let stack = _.concat(this.resource.data || [], resource.data);
					resource.data = stack;
				}

				this.resource = resource;
			},
			create() {
				this.showSpinner();

				setTimeout(() => {
					this.emitGlobalEvent('spaCreateResource');
					this.emitGlobalEvent('closeItems');
					this.showViewsBar();
					this.hideActions();
				}, 300);
			},
			edit(item) {
				this.showSpinner();

				setTimeout(() => {
					this.emitGlobalEvent('spaEditResource', item);
					this.emitGlobalEvent('closeItems');
					this.showViewsBar();
					this.showActions();
				}, 300);
			},
			catchSearchRequest({ q }) {
				this.onSearchMode = true;
				this.searchText = q;
				this.showSpinner();

				setTimeout(() => {
					this.refresh(this.page);
					this.hideSpinner();
				}, 2000);
			},
			clearSearch() {
				this.onSearchMode = false;
				this.searchText = '';
				this.showSpinner();

				setTimeout(() => {
					this.refresh(this.page);
					this.hideSpinner();
				}, 1000);
			},
		},
		mounted() {
			this.refresh();
			this.listenGlobalEvent('spaRefreshItems', this.refresh);
			this.listenGlobalEvent('spaRefreshCurrentItem', this.edit);
			this.listenGlobalEvent('makeSpaSearch', this.catchSearchRequest);
			this.listenGlobalEvent('clearSearch', this.clearSearch);
		},
	};
</script>
