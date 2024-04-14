<template>
	<div class="seccion" id="props" :class="{ max: $parent.editingOnShop == 'props' }">
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
				<div class="group" v-for="(propGroup, index) in propGroups" :key="index">
					<div class="input">
						<label>Variant</label>
						<input type="text" @keypress.enter="dontSaveOnEnter" placeholder="Variant" v-model="propGroup.name" />
						<div class="focus"></div>
					</div>

					<v-tags label="Values" input-name="prop_group" :tags-autocomplete="[]" :placeholder="'Type value + Enter '" :max-tags="10" :init-tags="[]" :index="index"></v-tags>

					<div class="input check">
						<input type="checkbox" name="is_color" v-model="propGroup.is_color" :true-value="1" :false-value="0" />
						<div class="checkbox">
							<i class="fa fa-check" aria-hidden="true"></i>
						</div>
						<label>Assign colors</label>
					</div>

					<div v-if="propGroup.is_color" class="colors">
						<div class="color" v-for="(prop, i) in propGroup.props" :key="i">
							<div class="input">
								<label>{{ prop.title }}</label>
								<input type="color" v-model="propGroup.props[i].color_hex_1" @keypress.enter="dontSaveOnEnter" placeholder="Color 1" />
								<input type="color" v-model="propGroup.props[i].color_hex_2" @keypress.enter="dontSaveOnEnter" placeholder="Color 2" />
							</div>
						</div>
					</div>
				</div>

				<button type="button" v-if="allowtoAddFirstPropGroup || allowtoAddPropGroup" @click="addPropGroup">Add variant</button>
			</div>

			<button type="button" @click="save" v-if="showSaveButton">Done</button>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['routes', 'product'],
		data() {
			return {
				propGroups: [],
				variants: [],
				props: [],
				availableVariants: [],
				unavailableVariants: [],
			};
		},
		computed: {
			showVariantDesigner() {
				return this.propGroups.length > 0 && !_.isEmpty(_.get(this.propGroups, '[0].props', []));
			},
			allowtoAddPropGroup() {
				return this.propGroups.length < 2 && !_.isEmpty(_.get(this.propGroups, '[0].props', []));
			},
			allowtoAddFirstPropGroup() {
				return _.isEmpty(this.propGroups);
			},
			showSaveButton() {
				let firstGroupName = _.get(this.propGroups, '[0].name');

				return !_.isUndefined(firstGroupName) && firstGroupName.length > 0;
			},
		},

		methods: {
			addPropGroup() {
				this.propGroups.push({
					name: '',
					props: [],
					is_color: 0,
				});
			},

			async save() {
				this.showSpinner();

				try {
					let { status, notification } = await window.axios.post(this.routes.props.replace('PRODUCT_ID', this.product.id), { props: this.propGroups });

					if (status && notification) {
						this.noty(notification);
						this.$parent.getItem(this.product);
					}
				} catch (error) {
					console.error(error);
				}

				this.hideSpinner();
			},
		},
		mounted() {
			this.listenGlobalEvent('new_tags_for_prop_group', (eventData) => {
				this.propGroups[eventData.index].props = [];

				_.each(eventData.tags, (tag) => {
					let prop = {
						title: tag,
						color_hex_1: null,
						color_hex_2: null,
						uuid: this.uuid(),
					};

					this.propGroups[eventData.index].props.push(prop);
				});
			});
		},
	};
</script>
