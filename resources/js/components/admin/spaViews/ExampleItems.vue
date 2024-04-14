<template>
	<div class="content">
		<div :class="`item ${itemClass}_item new`" @click="create">
			<label>Add</label>
		</div>

		<div :class="`item ${itemClass}_item`" @click="edit(result)" v-for="item in items" :key="item.id"></div>

		<div :class="`item ${itemClass}_item more`" v-if="loadmore">
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
				this.resource = await window.axios.get(`${this.routes.index}${page ? '?page=' + page : ''}`);
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
		},
		mounted() {
			this.refresh();
			this.listenGlobalEvent('spaRefreshItems', this.refresh);
			this.listenGlobalEvent('spaRefreshCurrentItem', this.edit);
		},
	};
</script>
