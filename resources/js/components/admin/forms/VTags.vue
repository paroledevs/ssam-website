<template>
	<div class="input tags-input" :class="{ off: isDisabled }">
		<label>{{ label }}</label>
		<input type="text" :placeholder="!isDisabled ? placeholder : ''" @keypress.enter="addTag" v-model="tag" />
		<div v-if="useFormRequest">
			<input type="hidden" :name="inputName" v-for="(t, index) in tags" :key="index" :value="t" />
		</div>

		<div class="tags">
			<div class="tag" v-for="(t, index) in tags" :key="index">
				<span>{{ t }}</span>
				<i class="fa fa-close" aria-hidden="true" @click="delTag(index)"></i>
			</div>

			<div v-if="showSuggestions">
				<div class="tag suggest" v-for="(t, index) in filteredTags" @click="addTag($event, t)" :key="index">
					<span>{{ t }}</span>
					<i class="fa fa-plus" aria-hidden="true"></i>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: ['label', 'initTags', 'inputName', 'tagsAutocomplete', 'placeholder', 'disabled', 'maxTags', 'useFormRequest', 'index'],
		data() {
			return {
				tags: this.initTags || [],
				tag: '',
			};
		},
		methods: {
			addTag(event, suggestedTag = null) {
				event.preventDefault();

				if (this.tag.length < 1) {
					return false;
				}

				if (_.indexOf(this.tags, this.tag) > -1) {
					return false;
				}

				if (this.maxTags && this.tags.length == this.maxTags) {
					return false;
				}

				this.tags.push(suggestedTag ? suggestedTag : this.tag);

				this.tag = '';
			},

			delTag(index) {
				this.tags.splice(index, 1);
			},
		},
		computed: {
			isDisabled() {
				return !_.isNull(this.disabled) && !_.isUndefined(this.disabled) && this.disabled;
			},
			showSuggestions() {
				return this.tag.length > 0;
			},
			filteredTags() {
				return this.tagsAutocomplete.filter((i) => {
					return i.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
				});
			},
		},
		watch: {
			tags: {
				deep: true,
				handler(tags) {
					let eventName = 'new_tags_for_' + this.inputName;

					this.emitGlobalEvent(eventName, {
						tags: this.tags,
						index: this.index,
					});
				},
			},
		},
	};
</script>
