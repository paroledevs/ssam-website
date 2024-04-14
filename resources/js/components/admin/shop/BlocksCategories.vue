<template>
	<div class="blockManager">
		<div class="form">
			<!-- ELEMENTOS DE FORM CREATE -->

			<div class="fotos">
				<div class="foto" v-if="keepInputs">
					<input type="file" name="category_cover" @change="setImage" accept="image/*" />
					<div class="type">
						<i class="fa fa-image" aria-hidden="true"></i>
						<label>Image</label>
					</div>
				</div>
			</div>

			<div class="input">
				<label>Category</label>
				<input type="text" name="title" v-model="title" placeholder="Category" />
				<div class="focus"></div>
			</div>

			<button type="button" @click="save">Add</button>
		</div>

		<div class="bloques">
			<div v-for="(block, position) in blocks" :key="block.id" :class="['bloque', block.kind]">
				<div class="preview" v-if="!block.edit_mode">
					<div class="imagen" :style="imgBackground(block.cover)"></div>
					<div class="texto">
						<span>{{ block.title }}</span>
					</div>
				</div>

				<!-- ELEMENTOS DE FORM EDIT-->
				<div class="edit" v-if="block.edit_mode">
					<div class="fotos">
						<div class="foto" v-if="keepInputs" :style="imgBackground(block.cover)">
							<input type="file" name="category_cover" @change="setImage" accept="image/*" />
							<div class="type">
								<i class="fa fa-image" aria-hidden="true"></i>
								<label>Image</label>
							</div>
						</div>
					</div>

					<div class="input onlyplaceholder">
						<input type="text" name="title" v-model="block.title" placeholder="Category" />
						<div class="focus"></div>
					</div>

					<div class="acciones">
						<button type="button" @click="save(block)" class="ok">Save</button>
						<button type="button" class="del" @click="cancelEdit">Cancel</button>
					</div>
				</div>

				<div class="actions" v-if="!block.edit_mode">
					<div class="action" @click="edit(block, position)">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</div>
					<div class="action del" @click="deleteBlock(block)">
						<i class="fa fa-close" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['routes', 'collectionId'],
		data() {
			return {
				blocks: [],
				block: null,
				keepInputs: true,
				cover: null,
				title: '',
			};
		},
		methods: {
			catchFiles(input) {
				if (input.name === 'category_cover') {
					this.cover = input.files[0];
				}
			},
			clear() {
				this.cover = null;
				this.title = '';
				this.keepInputs = false;
				this.cancelEdit();

				setTimeout(() => {
					this.keepInputs = true;
				}, 200);
			},
			async refreshBlocks() {
				try {
					let { data } = await window.axios.post(route('categories.index'), { collection: this.collectionId });
					this.blocks = data;
				} catch (error) {
					console.error(error);
				}
			},
			async save({ id, title }) {
				this.showSpinner();

				let block = {
					collection: this.collectionId,
					title: id ? title : this.title,
				};

				if (this.cover) {
					block.cover = this.cover;
				}

				try {
					if (id) {
						var { status, notification } = await window.axios.put(route('categories.update', [id]), block);
					} else {
						var { status, notification } = await window.axios.post(route('categories.store'), block);
					}

					if (status) {
						this.noty(notification);
						this.refreshBlocks();
						this.clear();
					}
				} catch (error) {
					console.error('error', error);
				}

				this.hideSpinner();
			},
			edit(block, position) {
				for (const index in this.blocks) {
					this.blocks[index].edit_mode = false;
				}

				this.blocks[position].edit_mode = true;
			},
			cancelEdit() {
				for (const index in this.blocks) {
					this.blocks[index].edit_mode = false;
				}
			},
			async deleteBlock({ id }) {
				if (confirm('Do you want to delete this category?')) {
					this.showSpinner();

					try {
						let { status, notification } = await window.axios.delete(route('categories.destroy', [id]));

						if (status) {
							this.noty(notification);
							this.refreshBlocks();
							this.clear();
						}
					} catch (error) {
						console.error(error);
					}

					this.hideSpinner();
				}
			},
		},

		mounted() {
			this.refreshBlocks();
			this.listenGlobalEvent('fileAddedToAnInput', this.catchFiles);
		},
	};
</script>
