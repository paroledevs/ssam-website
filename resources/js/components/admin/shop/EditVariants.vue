<template>
	<div class="seccion" id="editVariants" :class="{ max: $parent.editingOnShop == 'variants' }">
		<div class="task">
			<div class="title">
				<h6>Images & Prices</h6>
			</div>
			<div class="controls">
				<div class="control" id="edit" @click="$parent.editingOnShop = 'variants'">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<div class="control" id="close" @click="$parent.editingOnShop = null">
					<i class="fa fa-check" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="titles">
				<div class="title t_variant">
					<label>Variants</label>
				</div>
				<div class="title t_price">
					<label>Price</label>
				</div>
				<div class="title t_image">
					<label>Image</label>
				</div>
				<div class="title t_actions">
					<label>Available</label>
				</div>
			</div>

			<div class="variants" id="on" v-if="availableVariants.length > 0">
				<div class="variant" v-for="(variant, index) in availableVariants" :key="variant.id">
					<div class="v_content" id="preview" v-if="!variant.edit_mode">
						<div class="cell c_variant">
							<span>{{ variant.title }}</span>
						</div>
						<div class="cell c_price" @click="edit(variant, index)">
							<span>{{ money(variant.price) }}</span>
						</div>
						<div class="cell c_image" @click="edit(variant, index)">
							<div class="foto" :style="imgBackground(variant.cover)"></div>
						</div>
						<div class="cell c_actions">
							<div class="action" @click="setAsUnavailable(variant)">
								<i class="fa fa-check" aria-hidden="true"></i>
							</div>
						</div>
					</div>

					<div class="v_content" id="edit" v-if="variant.edit_mode">
						<div class="cell c_variant">
							<span>{{ variant.title }}</span>
						</div>
						<div class="cell c_price">
							<div class="input">
								<input type="text" name="price" v-model="price" @focus="$event.target.select()" />
							</div>
						</div>
						<div class="cell c_image">
							<div class="fotos">
								<div class="foto" :style="imgBackground(variant.cover)">
									<input type="file" name="variant_image" @change="setImage" accept="image/*" />
								</div>
								<div class="del"><i class="fa fa-close" aria-hidden="true"></i></div>
							</div>
						</div>
						<div class="cell c_actions">
							<div class="action" @click="setAsUnavailable(variant)">
								<i class="fa fa-check" aria-hidden="true"></i>
							</div>
						</div>
					</div>

					<div class="acciones" v-if="variant.edit_mode">
						<button type="button" @click="save">Save</button>
						<button type="button" class="del" @click="cancelEdit">Cancel</button>
					</div>
				</div>
			</div>

			<div class="variants" id="off" v-if="unavailableVariants.length > 0">
				<div class="variant" v-for="variant in unavailableVariants" :key="variant.id">
					<div class="v_content" id="preview">
						<div class="cell c_variant">
							<span>{{ variant.title }}</span>
						</div>
						<div class="cell c_price">
							<span>{{ money(variant.price) }}</span>
						</div>
						<div class="cell c_image">
							<div class="foto" :style="imgBackground(variant.cover)"></div>
						</div>
						<div class="cell c_actions">
							<div class="action" @click="setAsAvailable(variant)">
								<i class="fa fa-check" aria-hidden="true"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['routes', 'product'],
		data() {
			return {
				editMode: false,
				keepInputs: true,
				availableVariants: [],
				unavailableVariants: [],
				variants: [],
				variant: {},
				title: '',
				image: null,
				price: 0,
			};
		},
		methods: {
			async getVariants() {
				try {
					let { data } = await window.axios.get(this.routes.index.replace('PRODUCT_ID', this.product.id));

					this.variants = await data;
					this.splitVariants();
				} catch (error) {
					console.error(error);
				}
			},
			splitVariants() {
				this.availableVariants = this.variants.filter((variant) => {
					return variant.is_available;
				});

				this.unavailableVariants = this.variants.filter((variant) => {
					return !variant.is_available;
				});
			},
			async setAsAvailable(variant) {
				try {
					let { status, notification } = await window.axios.put(this.routes.update.replace('PRODUCT_ID', this.product.id).replace('ID', variant.id), { is_available: 1 });

					if (status) {
						this.getVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}
			},
			async setAsUnavailable(variant) {
				try {
					let { status, notification } = await window.axios.delete(this.routes.destroy.replace('PRODUCT_ID', this.product.id).replace('ID', variant.id));

					if (status) {
						this.getVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}
			},
			clear() {
				this.variant = {};
				this.title = '';
				this.image = null;
				this.price = 0;
				this.keepInputs = false;
				this.editMode = false;

				setTimeout(() => {
					this.keepInputs = true;
				}, 200);
			},
			cancelEdit() {
				this.clear();
				for (const index in this.availableVariants) {
					this.availableVariants[index].edit_mode = false;
				}
			},
			edit(variant, index) {
				this.cancelEdit();
				this.availableVariants[index].edit_mode = true;

				this.variant = variant;
				this.title = variant.title;
				this.price = variant.price;
				this.image = null;
			},
			catchImage(input) {
				if (input.name === 'variant_image') {
					this.image = input.files[0];
				}
			},
			async save() {
				let updatedVariant = {
					price: this.price,
				};

				if (this.image) {
					updatedVariant.image = this.image;
				}

				try {
					let { status, notification } = await window.axios.put(this.routes.update.replace('PRODUCT_ID', this.product.id).replace('ID', this.variant.id), updatedVariant);

					if (status) {
						this.clear();
						this.getVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}
			},

			selectPrice() {},
		},
		mounted() {
			this.getVariants();
			this.listenGlobalEvent('refresh_product_variants', this.getVariants);
			this.listenGlobalEvent('fileAddedToAnInput', this.catchImage);
		},
	};
</script>
