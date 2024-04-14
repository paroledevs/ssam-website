<template>
	<div class="formularios" :id="`${itemClass}_form`" v-if="show">
		<!-- CREATE -->

		<div class="seccion" v-if="!onEditMode">
			<div class="content">
				<product-base-form></product-base-form>
			</div>
		</div>

		<div class="ShopProduct" v-if="onEditMode">
			<!-- PRODUCT -->

			<div id="product">
				<div class="product">
					<div class="foto">
						<div class="blurfoto" :style="imgBackground(item.cover)"></div>
					</div>
					
					<div class="texto">
						<strong>{{ item.title }}</strong>
						<b>${{ item.price }}</b>
					</div>
				</div>
			</div>

			<!-- EDIT GENERAL -->

			<div class="seccion" :class="{ max: editingOnShop == 'base' }">
				<div class="task">
					<div class="title">
						<h6>Product info</h6>
					</div>
					<div class="controls">
						<div class="control" id="edit" @click="editingOnShop = 'base'">
							<i class="fa fa-pencil" aria-hidden="true"></i>
						</div>
						<div class="control" id="close" @click="editingOnShop = null">
							<i class="fa fa-check" aria-hidden="true"></i>
						</div>
					</div>
				</div>

				<div class="content">
					<product-base-form></product-base-form>
				</div>
			</div>

			<!-- CREATE PROPS -->

			<props :product="item" :routes="routes.masive" v-if="!onVariantsEditMode"></props>

			<!-- EDIT PROPS -->

			<edit-props :product="item" :routes="routes.propGroups" v-if="onVariantsEditMode"></edit-props>

			<!-- EDIT VARIANTS -->

			<edit-variants :product="item" :routes="routes.variants" v-if="onVariantsEditMode"></edit-variants>

			<!-- EDIT TAGS -->

			<edit-tags :product="item" :routes="routes.tagGroups"></edit-tags>

			<!-- GALLERY -->

			<product-gallery :product="item" :routes="routes.images" format="triple"></product-gallery>
			
			
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
				showProductForm: false,

				// Data
				item: {},
				title: '',
				cover: null,
				description: '',
				price: 0,
				is_available: 1,
				collections: [],
				collection: null,
				category: null,
				editingOnShop: null,
				selectedCollection: {},
			};
		},
		computed: {
			onEditMode() {
				return this.item.hasOwnProperty('id');
			},
			onVariantsEditMode() {
				return this.item.has_variants;
			},
		},
		watch: {
			item: {
				deep: true,
				handler(item) {
					this.updateProps(item);
				},
			},
			onEditMode(onEditMode) {
				this.showProductForm = this.onEditMode ? false : true;
			},
			collection(collection) {
				this.selectedCollection = _.find(this.collections, ['id', collection]);
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
			async getCollections() {
				try {
					let { data } = await window.axios.get(this.routes.collections);
					this.collections = data;

					if (_.size(this.collections) > 0) {
						this.collection = _.get(this.collections, '[0].id', null);
					}
				} catch (error) {
					console.error(error);
				}
			},
			updateProps(item) {
				if (item.id) {
					this.title = item.title;
					this.cover = null;
					this.description = item.description;
					this.price = item.price;
					this.is_available = item.is_available;
					this.collection = item.collection?.id;
					if (item.category) {
						this.category = item.category.id;
						this.collection = item.category?.categorizable_id;
					}
				}
			},
			catchFile(input) {
				if (input.name === 'product_cover') {
					this.cover = input.files[0];
				}
			},
			clear() {
				// Control
				this.item = {};
				this.show = false;
				this.keepFileInputs = false;
				this.title = '';
				this.cover = null;
				this.description = '';
				this.price = 0;
				this.is_available = 1;
				this.category = null;
				this.getCollections();

				// Data

				setTimeout(() => {
					this.keepFileInputs = true;
				}, 300);
			},
			async save() {
				try {
					this.showSpinner();

					let requestData = {
						title: this.title,
						description: this.description,
						price: this.price,
						is_available: this.is_available,
						morph_type: this.category ? 'category' : 'collection',
						morph_id: this.category ? this.category : this.collection,
					};

					if (this.cover) {
						requestData.cover = this.cover;
					}

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
			this.getCollections();

			this.listenGlobalEvent('spaCreateResource', () => {
				this.clear();

				setTimeout(() => {
					this.show = true;
					this.hideSpinner();
				}, 200);
			});

			this.listenGlobalEvent('spaEditResource', (item) => {
				this.clear();
				this.getItem(item);

				setTimeout(() => {
					this.show = true;
					this.hideSpinner();
				}, 200);
			});

			this.listenGlobalEvent('fileAddedToAnInput', this.catchFile);
			this.listenGlobalEvent('spaDeleteItem', this.destroy);
			this.listenGlobalEvent('spaLiveViewItem', this.liveView);
		},
	};
</script>
