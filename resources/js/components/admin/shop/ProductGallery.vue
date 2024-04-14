<template>
	<div class="seccion" id="productGallery" :class="{ max: $parent.editingOnShop == 'gallery' }">
		<div class="task">
			<div class="title">
				<h6>Product Gallery</h6>
			</div>
			<div class="controls">
				<div class="control" id="edit" @click="$parent.editingOnShop = 'gallery'">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<div class="control" id="close" @click="$parent.editingOnShop = null">
					<i class="fa fa-check" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="content">
			<v-gallery :label="label" :format="format" :reorder="reorder" :for-products="forProducts" :routes="routes" :product="product"></v-gallery>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['label', 'format', 'reorder', 'routes', 'forProducts', 'product'],
		data() {
			return {
				images: [],
				input: true,
			};
		},
		methods: {
			async refreshGallery() {
				try {
					let { data } = await window.axios.get(this.replaceRoute(this.routes.index));
					this.images = data;
				} catch (error) {
					console.error(error);
				}
			},
			resetInput() {
				this.input = false;

				setTimeout(() => {
					this.input = true;
				}, 300);
			},
			replaceRoute(route, id = null) {
				let finalRoute = route.replace('PRODUCT_ID', this.product.id);

				return id ? finalRoute.replace('ID', id) : finalRoute;
			},
			async save(event) {
				let input = event.target;

				if (!_.isEmpty(input.files)) {
					this.showSpinner();

					let images = [];

					_.each(input.files, (file) => {
						images.push(file);
					});

					try {
						let { status, notification } = await window.axios.post(this.replaceRoute(this.routes.store), {
							images: images,
						});

						if (status) {
							this.noty(notification);
							this.resetInput();
							this.refreshGallery();
						}
					} catch (error) {
						console.error(error);
					}

					this.hideSpinner();
				}
			},

			async removeImage(image) {
				if (confirm('Do you want to delete this image?')) {
					this.showSpinner();

					try {
						let { status, notification } = await window.axios.delete(this.replaceRoute(this.routes.destroy, image.id));
						if (status) {
							this.noty(notification);
							this.resetInput();
							this.refreshGallery();
						}
					} catch (error) {
						console.error(error);
					}

					this.hideSpinner();
				}
			},
		},

		mounted() {
			this.refreshGallery();
		},
	};
</script>
