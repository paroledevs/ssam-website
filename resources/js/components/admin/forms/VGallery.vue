<template>
	<div class="blockManager galeria">
		<div class="form">
			<div class="fotos" id="galleryPhoto">
				<div class="foto">
					<input type="file" accept="image/*" multiple name="images[]" @change="save" v-if="input" />
					<div class="type">
						<i class="fa fa-plus" aria-hidden="true"></i>
						<label>{{ label }}</label>
					</div>
				</div>
			</div>
		</div>

		<div class="bloques miniaturas" :class="format">
			<div class="bloque miniatura" v-for="(image, index) in images" :key="index" :class="{ contain: forProducts }">
				<div class="preview">
					<div class="imagen" :style="imgBackground(image.url)"></div>
				</div>
				<div class="actions">
					<div class="action del" @click="removeImage(image)">
						<i class="fa fa-close" aria-hidden="true"></i>
					</div>
					<div class="action" v-if="reorder">
						<i class="fa" :class="[{ 'fa-caret-up': format == 'single' }, { 'fa-caret-left': format != 'single' }]" aria-hidden="true"></i>
					</div>
					<div class="action" v-if="reorder">
						<i class="fa" :class="[{ 'fa-caret-down': format == 'single' }, { 'fa-caret-right': format != 'single' }]" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
    export default {
    	props: ['label', 'format', 'reorder', 'routes', 'forProducts', 'parentId', 'parentName'],
    	data() {
    		return {
    			images: [],
    			input: true,
    		};
    	},
    	computed: {
    		requestData() {
    			if (this.parentId && this.parentName) {
    				let requestData = {};

    				requestData[this.parentName] = this.parentId;

    				return requestData;
    			}

    			return {};
    		},
    	},
    	methods: {
    		async refreshGallery() {
    			try {
    				var { data } = await window.axios.post(this.route('images.index'), {
    					...this.requestData,
    				});

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
    		async save(event) {
    			let input = event.target;

    			if (!_.isEmpty(input.files)) {
    				this.showSpinner();

    				let images = [];

    				_.each(input.files, (file) => {
    					images.push(file);
    				});

    				try {
    					let { status, notification } = await window.axios.post(this.route('images.store'), {
    						...this.requestData,
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
    					let { status, notification } = await window.axios.delete(this.route('images.destroy', { image: image.id }));

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
