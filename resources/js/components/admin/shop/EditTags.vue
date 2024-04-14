<template>

	<div class="seccion" id="editTags" :class="{max:$parent.editingOnShop == 'tags'}">
		<div class="task">
			<div class="title">
				<h6>Extras</h6>
				<div class="info">
					<div class="ico"><i class="fa fa-question-circle" aria-hidden="true"></i></div>
					<div class="tip">
						<small>Product changes that NOT affects the price. i.e. Color, size, material.</small>
					</div>
				</div>
			</div>
			<div class="controls">
				<div class="control" id="edit" @click="$parent.editingOnShop = 'tags'">
					<i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<div class="control" id="close" @click="$parent.editingOnShop = null">
					<i class="fa fa-check" aria-hidden="true"></i>
				</div>
			</div>
		</div>
		<div class="content">
				
				
				<div class="groups">
					 
		
					<div class="group" v-for="(group, index) in groups" :key="group.id">
						<div class="title">
							<div class="preview">
								<strong>{{ group.name }}</strong>
								<div class="ico" @click="editGroup(index)">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</div>
							</div>
							
							<div class="edit" v-if="group.edit_mode">
								<div class="input">
									<label>Tag name</label>
									<input type="text" v-model="group.name" placeholder="Tag name" />
									<div class="focus"></div>
								</div>
								<div class="acciones">
									<button type="submit" @click="saveGroup(group)">Save</button>
									<button type="button" class="del" @click="cancelEditGroup">Cancel</button>
								</div>
							</div>
						</div>
		
						<div class="values">
							<div class="value" v-for="tag in group.tags" :key="tag.id">
								<span>{{ tag.title }}</span>
								<div class="colors" v-if="group.is_color">
									<div class="color" v-if="tag.color_hex_1" :style='"background:" + tag.color_hex_1'></div>
									<div class="color" v-if="tag.color_hex_2" :style='"background:" + tag.color_hex_2'></div>
								</div>
								<div class="actions">
									<div class="action" @click="editTag(tag, index)">
										<i class="fa fa-pencil" aria-hidden="true"></i>
									</div>
									<div class="action" @click="deleteTag(tag, group)">
										<i class="fa fa-close" aria-hidden="true"></i>
									</div>
								</div>
							</div>
		
							<div class="plus" @click="createTag(index)">
								<i class="fa fa-plus" aria-hidden="true"></i>
							</div>
						</div>
		
						<div class="modify" v-if="group.edit_create_tag">
							<div class="input">
								<label>Value</label>
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
								<button type="submit" @click="saveTag(group)">Save</button>
								<button type="button" class="del" @click="clearTag(true)">Cancel</button>
							</div>
						</div>
						
					</div>
					
					
					
					<div class="group" v-if="creatingGroup">
						<div class="input">
							<label>Extra</label>
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
					
					<button type="button" @click="createGroup()" v-if="allowtoAddtagsGroup">Add Extra</button>

					
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
				tag: {},
				newGroup: {
					name: '',
					is_color: false,
				},
				title: '',
				color_hex_1: '',
				color_hex_2: '',
				creatingGroup: false,
			};
		},
		computed: {
			allowtoAddtagsGroup() {
				
				let groups = this.groups.length - 1;
				
				if(groups < 0){
					return true;
				}else{
					return  !_.isEmpty(_.get(this.groups, '['+ groups +'].tags', []));
				}
				
				
			},
		},
		methods: {
			async getTags() {
				try {
					let { data } = await window.axios.get(this.routes.groups.index.replace('PRODUCT_ID', this.product.id));

					this.groups = data;
				} catch (error) {
					console.error(error);
				}
			},
			createTag(index) {
				this.clearTag();
				this.groups[index].edit_create_tag = true;
			},
			createGroup(index) {
				this.clearTag();

				this.creatingGroup = true;

				if (index) {
					this.groups[index].edit_create_tag = true;
				}

			},
			cancelCreate() {
				this.creatingGroup = false;

				for (const i in this.groups) {
					this.groups[i].edit_create_tag = false;
				}
			},
			editGroup(position) {
				this.clearTag();

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
			editTag(tag, index) {
				this.clearTag();

				this.tag = tag;
				this.title = tag.title;
				this.color_hex_1 = tag.color_hex_1;
				this.color_hex_2 = tag.color_hex_2;

				this.groups[index].edit_create_tag = true;
			},
			clearTag() {
				this.cancelCreate();

				this.tag = {};
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
						this.clearTag();
						this.getTags();
						this.refreshVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}

				this.hideSpinner();
			},
			async saveTag(group) {
				let tag = {
					title: this.title,
					color_hex_1: this.color_hex_1,
					color_hex_2: this.color_hex_2,
				};

				try {
					if (this.tag.hasOwnProperty('id')) {
						var { status, notification } = await window.axios.put(this.routes.tags.update.replace('GROUP_ID', group.id).replace('ID', this.tag.id), tag);
					} else {
						var { status, notification } = await window.axios.post(this.routes.tags.store.replace('GROUP_ID', group.id), tag);
					}

					if (status) {
						this.clearTag();
						this.getTags();
						this.refreshVariants();
						this.noty(notification);
					}
				} catch (error) {
					console.error(error);
				}
			},
			async deleteTag(tag, group) {
				if (confirm(`Do you want delete ${tag.title} variant?`)) {
					try {
						let { status, notification } = await window.axios.delete(this.routes.tags.destroy.replace('GROUP_ID', group.id).replace('ID', tag.id));

						if (status) {
							this.clearTag();
							this.getTags();
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
			this.getTags();
		},
	};
</script>
