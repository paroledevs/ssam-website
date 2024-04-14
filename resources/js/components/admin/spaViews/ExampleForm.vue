<template>
	<div class="formularios" :id="`${itemClass}_form`" v-if="show">
		
		
		<!-- CREATE -->
			
		<div class="seccion" v-if="!onEditMode">
			
		</div>
		
		<!-- EDIT -->
		
		<div class="section" v-if="onEditMode">
		
	
		
		</div>
		
	</div>
</template>

<script>
	export default {
		props: {
			routes: {
				default: {},
			},
			itemClass: {
				default: 'product',
			},
		},
		data() {
			return {
				// Control
				keepFileInputs: true,
				show: false,

				// Data
				item: {},
			};
		},
		computed: {
			onEditMode() {
				return this.item.hasOwnProperty('id');
			},
		},
		watch: {
			item: {
				deep: true,
				handler(item) {
					this.updateProps(item);
				},
			},
		},
		methods: {
			async getItem(item) {
				try {
					let { data } = await window.axios.get(this.routes.update.replace('ID', item.id));
					this.item = data;
				} catch (error) {
					console.error(error);
				}
			},
			updateProps(item) {
				if (item.id) {
					
				}
			},
			catchFile(input) {
				if (input.name === '') {
					
				}
			},
			clear() {
				// Control
				this.item = {};
				this.show = false;
				this.keepFileInputs = false;

				// Data

				setTimeout(() => {
					this.keepFileInputs = true;
				}, 300);
			},
			async save() {
				try {
					this.showSpinner();

					let requestData = {
						
					};

					if (this.onEditMode) {
						var { status, data, notification } = await window.axios.put(this.routes.update.replace('ID', this.item.id), requestData);
					} else {
						var { status, data, notification } = await window.axios.post(this.routes.store, requestData);

						if (status) {
							this.emitGlobalEvent('closeItems');
							this.showViewsBar();
							this.showActions();
						}
					}

					if (status) {
						this.noty(notification);
						this.item = data;
						this.emitGlobalEvent('spaRefreshItems');
						this.showActions();
					}

					this.hideSpinner();
				} catch (error) {
					console.error(error);
				} 
			},
			async destroy() {
				if (confirm('Are you sure you want to delete this item?')) {
					this.showSpinner();

					try {
						var { status, notification } = await window.axios.delete(this.routes.update.replace('ID', this.item.id));

						if (status) {
							this.noty(notification);
							this.emitGlobalEvent('spaRefreshItems');
							this.clear();
							this.show = false;
							this.hideViewsBar();
						}
					} catch (error) {
						console.error(error);
					}

					this.hideSpinner();
				}
			},
			async liveView() {
				if (this.item.id) {
					try {
						let { url } = await window.axios.get(this.routes.site.replace('ID', this.item.id));
						var win = window.open(url, '_blank');
					} catch (error) {
						console.error(error);
					}
				}
			},
		},
		mounted() {

			this.listenGlobalEvent('spaCreateResource', () => {
				this.clear();
				this.show = true;

				setTimeout(() => {
					this.hideSpinner();
				}, 200);
			});

			this.listenGlobalEvent('spaEditResource', (item) => {
				this.clear();

				this.show = true;
				this.getItem(item);
				setTimeout(() => {
					this.hideSpinner();
				}, 200);
			});

			this.listenGlobalEvent('fileAddedToAnInput', this.catchFile);
			this.listenGlobalEvent('spaDeleteItem', this.destroy);
			this.listenGlobalEvent('spaLiveViewItem', this.liveView);
		},
	};
</script>
