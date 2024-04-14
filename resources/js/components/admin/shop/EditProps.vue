<template>
	<div class="seccion" id="editProps" :class="{max:$parent.editingOnShop == 'props'}">
		<div class="task">
			<div class="title">
				<h6>Variants</h6>
				<div class="info">
					<div class="ico"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
					<div class="tip">
						<small>Product changes that affects the price. i.e. Color, size, material.</small>
					</div>
				</div>
			</div>
			<div class="controls">
				<div class="control" id="edit" @click="$parent.editingOnShop = 'props'">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<div class="control" id="close" @click="$parent.editingOnShop = null">
					<i class="fa fa-check" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="groups">
				
	
				<div class="group" v-for="(group, index) in groups" :key="index">
					<div class="title">
						<div class="preview">
							<strong>{{ group.name }}</strong>
							<div class="ico" @click="editGroup(index)">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</div>
						</div>
						<div class="edit" v-if="group.edit_mode">
							<div class="input">
								<label>Variant name</label>
								<input type="text" v-model="group.name" placeholder="Variant name" />
								<div class="focus"></div>
							</div>
							<div class="acciones">
								<button type="submit" @click="saveGroup(group)">Save</button>
								<button type="button" class="del" @click="cancelEditGroup">Cancel</button>
							</div>
						</div>
					</div>
	
					<div class="values">
						<div class="value" v-for="prop in group.props" :key="prop.id">
							<span>{{ prop.title }}</span>
							<div class="colors" v-if="group.is_color">
								<div class="color" v-if="prop.color_hex_1" :style='"background:" + prop.color_hex_1'></div>
								<div class="color" v-if="prop.color_hex_2" :style='"background:" + prop.color_hex_2'></div>
							</div>
							<div class="actions">
								<div class="action edit" @click="editProp(prop, index)">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</div>
								<div class="action del" @click="deleteProp(prop, group)">
									<i class="fa fa-close" aria-hidden="true"></i>
								</div>
							</div>
						</div>
	
						<div class="plus" @click="createProp(index)">
							<i class="fa fa-plus" aria-hidden="true"></i>
						</div>
					</div>
	
					<div class="modify" v-if="editingProp && group.edit_create_prop">
						<div class="input">
							<label>Edit Value</label>
							<input type="text" v-model="title" placeholder="Edit Value" />
							<div class="focus"></div>
						</div>
						<div class="color" v-if="group.is_color">
							<div class="input">
								<label>Colors</label>
								<input type="color" v-model="color_hex_1" @keypress.enter="dontSaveOnEnter" placeholder="Color 1" />
								<input type="color" v-model="color_hex_2" @keypress.enter="dontSaveOnEnter" placeholder="Color 2" />
							</div>
						</div>
						<div class="acciones">
							<button type="submit" @click="saveProp(group)">Save</button>
							<button type="button" class="del" @click="clearProp(true)">Cancel</button>
						</div>
					</div>
	
					
				</div>
				
				<div class="group" v-if="creatingGroup">
					<div class="input">
						<label>Variant</label>
						<input type="text" placeholder="Variant" v-model="newGroup.name" />
						<div class="focus"></div>
					</div>
	
					<div class="input check">
						<input type="checkbox" name="is_color" v-model="newGroup.is_color" :true-value="1" :false-value="0" />
						<div class="checkbox">
							<i class="fa fa-check" aria-hidden="true"></i>
						</div>
						<label>Is Color</label>
					</div>
	
					<div class="acciones">
						<button type="submit" @click="saveGroup(newGroup)">Save</button>
						<button type="button" class="del" @click="cancelCreate">Cancel</button>
					</div>
				</div>
				
				
				<button type="button" @click="createGroup(true)" v-if="allowCreateGroup">Add variant</button>
				
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['product', 'routes'],
		data() {
			return {
				groups: [],
				prop: {},
				newGroup: {
					name: '',
					is_color: 0,
				},
				title: '',
				color_hex_1: '',
				color_hex_2: '',
				creatingGroup: false,
				editingProp: false,
			};
		},
		computed: {
			allowCreateGroup() {
				return this.groups.length < 2;
			},
		},
		methods: {
			async getProps() {
				try {
					let { data } = await window.axios.get(this.routes.groups.index.replace('PRODUCT_ID', this.product.id));

					this.groups = data;
				} catch (error) {
					console.error(error);
				}
			},
			createProp(index) {
				this.clearProp();
				this.editingProp = true;
				this.groups[index].edit_create_prop = true;
			},
			createGroup(isGroup = false, index) {
				this.clearProp();

				this.creatingGroup = isGroup;

				if (index) {
					this.groups[index].edit_create_prop = true;
				}

				if (_.isEmpty(this.groups)) {
					this.groups.push({
						name: '',
						is_color: 0,
					});
				}
			},
			cancelCreate() {
				this.creatingGroup = false;
				this.editingProp = false;

				for (const i in this.groups) {
					this.groups[i].edit_create_prop = false;
				}
			},
			editGroup(position) {
				this.clearProp();

				for (const index in this.groups) {
					this.groups[index].edit_mode = false;
				}

				this.groups[position].edit_mode = true;
			},
			cancelEditGroup() {
				for (const index in this.groups) {
					this.groups[index].edit_mode = false;
				}
			},
			editProp(prop, index) {
				
				this.clearProp();

				this.prop = prop;
				this.title = prop.title;
				this.color_hex_1 = prop.color_hex_1;
				this.color_hex_2 = prop.color_hex_2;

				this.groups[index].edit_create_prop = true;
				this.editingProp = true;
			},
			clearProp() {
				this.cancelCreate();
				this.cancelEditGroup();

				this.prop = {};
				this.title = '';
				this.color_hex_1 = '';
				this.color_hex_2 = '';
			},
			refreshVariants() {
				this.emitGlobalEvent('refresh_product_variants');
			},
			async saveGroup(group) {
				this.showSpinner();

				try {
					if (group && group.hasOwnProperty('id')) {
						var { status, notification } = await window.axios.put(this.routes.groups.update.replace('PRODUCT_ID', this.product.id).replace('ID', group.id), { name: group.name });
					} else {
						var { status, notification } = await window.axios.post(this.routes.groups.store.replace('PRODUCT_ID', this.product.id), group);
					}

					if (status) {
						this.clearProp();
						this.getProps();
						this.refreshVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}

				this.hideSpinner();
			},
			async saveProp(group) {
				let prop = {
					title: this.title,
					color_hex_1: this.color_hex_1,
					color_hex_2: this.color_hex_2,
				};

				try {
					if (this.prop.hasOwnProperty('id')) {
						var { status, notification } = await window.axios.put(this.routes.props.update.replace('GROUP_ID', group.id).replace('ID', this.prop.id), prop);
					} else {
						var { status, notification } = await window.axios.post(this.routes.props.store.replace('GROUP_ID', group.id), prop);
					}

					if (status) {
						this.clearProp();
						this.getProps();
						this.refreshVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}
			},
			async deleteProp(prop, group) {
				if (confirm(`Do ypu want to delete all ${prop.title} variants?`)) {
					try {
						let { status, notification } = await window.axios.delete(this.routes.props.destroy.replace('GROUP_ID', group.id).replace('ID', prop.id));

						if (status) {
							this.clearProp();
							this.getProps();
							this.refreshVariants();
							this.noty(notification);
						} else {
							this.noty(notification, 'error');
						}
					} catch (error) {
						console.error(error);
					}
				}
			},
		},
		mounted() {
			this.getProps();
		},
	};
</script>
