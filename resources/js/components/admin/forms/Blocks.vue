<template>
	<div class="blockManager">
		<div class="types">
			<div class="type" @click="selectedLayout = 1" :class="{ active: selectedLayout === 1 }">
				<i class="fa fa-quote-right" aria-hidden="true"></i>
				<div class="tip">
					<small>Título</small>
				</div>
			</div>

			<div class="type" @click="selectedLayout = 2" :class="{ active: selectedLayout === 2 }">
				<i class="fa fa-font" aria-hidden="true"></i>
				<div class="tip">
					<small>Parrafo</small>
				</div>
			</div>

			<div class="type" @click="selectedLayout = 3" :class="{ active: selectedLayout === 3 }">
				<i class="fa fa-list-ul" aria-hidden="true"></i>
				<div class="tip">
					<small>Lista</small>
				</div>
			</div>
			<!--
			<div class="type" @click="selectedLayout = 4" :class="{ active: selectedLayout === 4 }">
				<i class="fa fa-link" aria-hidden="true"></i>
				<div class="tip">
					<small>Link</small>
				</div>
			</div>

			<div class="type" @click="selectedLayout = 2" :class="{ active: selectedLayout === 2 }">
				<i class="fa fa-image" aria-hidden="true"></i>
				<div class="tip">
					<small>Add image block</small>
				</div>
			</div>

			<div class="type" @click="selectedLayout = 5" :class="{ active: selectedLayout === 5 }">
				<i class="fa fa-youtube-play" aria-hidden="true"></i>
				<div class="tip">
					<small>Add embed video</small>
				</div>
			</div>
-->
		</div>

		<div class="form">
			<!-- ELEMENTOS DE FORM CREATE -->

			<div class="input" v-if="creatingTextOrQuote">
				<label>Text</label>
				<textarea placeholder="Text" rows="8" v-model="text"></textarea>
				<div class="focus"></div>
			</div>

			<div class="fotos" id="block_image" v-if="creatingImage">
				<div class="foto" v-if="keepInputs">
					<input type="file" name="cover" @change="setImage" accept="image/*" />
					<div class="type">
						<i class="fa fa-image" aria-hidden="true"></i>
						<label>Image</label>
					</div>
				</div>
			</div>

			<div class="input" v-if="creatingImage">
				<label>Photo info</label>
				<input type="text" placeholder="Photo info" v-model="photo_info" />
				<div class="focus"></div>
			</div>

			<div class="input" v-if="creatingLink">
				<label>Link text</label>
				<input type="text" placeholder="Link text" v-model="link_text" />
				<div class="focus"></div>
			</div>

			<div class="input" v-if="creatingLink">
				<label>Link button</label>
				<input type="text" placeholder="Link button" v-model="link_button" />
				<div class="focus"></div>
			</div>

			<div class="input" v-if="creatingLink">
				<label>Link</label>
				<input type="text" placeholder="Link" v-model="link" />
				<div class="focus"></div>
			</div>

			<div class="input" v-if="creatingVideo">
				<label>Video URL</label>
				<input type="text" placeholder="Video URL" v-model="video_url" />
				<div class="focus"></div>
			</div>

			<div class="input" v-if="creatingVideo">
				<label>Video Info</label>
				<input type="text" placeholder="Video Info" v-model="video_description" />
				<div class="focus"></div>
			</div>

			<button type="button" @click="save">Add</button>
		</div>

		<div class="bloques">
			<div v-for="(block, position) in blocks" :key="block.id" :class="['bloque', block.layout]">
				<div class="preview" v-if="!block.edit_mode">
					<!--IMAGEN-->
					<div class="imagen" v-if="block.is_image">
						<img :src="block.cover" />
					</div>

					<div class="info" v-if="block.is_image">
						<span>{{ block.photo_info }}</span>
					</div>

					<!--TEXTO-->
					<span v-if="block.is_text_or_quote">{{ block.text }}</span>

					<!--LINK-->
					<span v-if="block.is_link">
						{{ block.link_text }}
						<a :href="block.link">
							<u>{{ block.link_button }}</u>
						</a>
					</span>

					<!--VIDEO-->
					<v-embed-video :url="block.video_url" v-if="block.is_video"></v-embed-video>

					<div class="info" v-if="block.is_video">
						<span>{{ block.video_description }}</span>
					</div>
				</div>

				<div class="edit" v-if="block.edit_mode">
					<!-- ELEMENTOS DE FORM EDIT-->

					<div class="input" v-if="block.is_text_or_quote">
						<label>Text</label>
						<textarea placeholder="Text" rows="8" v-model="block.text"></textarea>
						<div class="focus"></div>
					</div>

					<div class="fotos" id="block_image" v-if="block.is_image">
						<div class="foto" v-if="keepInputs" :style="imgBackground(block.cover)">
							<input type="file" name="cover" @change="setImage" accept="image/*" />
							<div class="type">
								<i class="fa fa-image" aria-hidden="true"></i>
								<label>Image</label>
							</div>
						</div>
					</div>

					<div class="input" v-if="block.is_image">
						<label>Photo info</label>
						<input type="text" placeholder="Photo info" v-model="block.photo_info" />
						<div class="focus"></div>
					</div>

					<div class="input" v-if="block.is_link">
						<label>Link text</label>
						<input type="text" placeholder="Photo info" v-model="block.link_text" />
						<div class="focus"></div>
					</div>

					<div class="input" v-if="block.is_link">
						<label>Link button</label>
						<input type="text" placeholder="Link button" v-model="block.link_button" />
						<div class="focus"></div>
					</div>

					<div class="input" v-if="block.is_link">
						<label>Link</label>
						<input type="text" placeholder="Link" v-model="block.link" />
						<div class="focus"></div>
					</div>

					<div class="input" v-if="block.is_video">
						<label>Video URL</label>
						<input type="text" placeholder="Video URL" v-model="block.video_url" />
						<div class="focus"></div>
					</div>

					<div class="input" v-if="block.is_video">
						<label>Video Info</label>
						<input type="text" placeholder="Video Info" v-model="block.video_description" />
						<div class="focus"></div>
					</div>

					<div class="acciones">
						<button type="button" @click="save(block)" class="ok">Guardar</button>
						<button type="button" class="del" @click="cancelEdit">Cancelar</button>
					</div>
				</div>

				<div class="actions double" v-if="!block.edit_mode">
					<div class="action" @click="edit(block, position)">
						<i class="fa fa-pencil" aria-hidden="true"></i>
					</div>
					<div class="action del" @click="deleteBlock(block)">
						<i class="fa fa-close" aria-hidden="true"></i>
					</div>
					<div class="action" @click="move(block, 'up')">
						<i class="fa fa-caret-up" aria-hidden="true"></i>
					</div>
					<div class="action" @click="move(block, 'down')">
						<i class="fa fa-caret-down" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
    import VEmbedVideo from '@/lazycomponents/VEmbedVideo';
</script>


<script>
    export default {
    	props: ['routes', 'postId'],
    	data() {
    		return {
    			// Data
    			blocks: [],
    			block: null,
    			cover: null,
    			text: null,
    			link_text: null,
    			link_button: null,
    			link: null,
    			photo_info: null,
    			video_url: null,
    			video_description: null,
    			// Control
    			selectedLayout: 1,
    			layouts: {
    				1: 'title',
    				2: 'text',
    				3: 'list',
    			},
    			keepInputs: true,
    		};
    	},
    	computed: {
    		creatingTextOrQuote() {
    			return this.selectedLayout === 1 || this.selectedLayout === 2 || this.selectedLayout === 3;
    		},
    		creatingImage() {
    			return this.selectedLayout === 4;
    		},
    		creatingLink() {
    			return this.selectedLayout === 5;
    		},
    		creatingVideo() {
    			return this.selectedLayout === 6;
    		},
    		creatingList() {
    			return this.selectedLayout === 3;
    		},
    	},
    	methods: {
    		async getBlocks() {
    			try {
    				let { data } = await window.axios.post(this.routes.index, { post: this.postId });

    				this.blocks = _.sortBy(data, ['position']);
    			} catch (error) {
    				console.table(error);
    			}
    		},
    		catchFiles({ name, files }) {
    			switch (name) {
    				case 'cover':
    					this.cover = files[0];
    					break;
    			}
    		},
    		clear() {
    			// Data
    			this.selectedLayout = 1;
    			this.text = null;
    			this.cover = null;
    			this.link_text = null;
    			this.link_button = null;
    			this.link = null;
    			this.photo_info = null;
    			this.video_url = null;
    			this.video_description = null;

    			// Control
    			this.keepInputs = false;

    			setTimeout(() => {
    				this.keepInputs = true;
    			}, 500);
    		},
    		async save({ id, layout, text, link_button, link_text, link, photo_info, video_url, video_description }) {
    			this.showSpinner();

    			let block = {
    				post: this.postId,
    				layout: layout || this.layouts[this.selectedLayout],
    				...(this.text && { text: this.text }),
    				...(this.cover && { cover: this.cover }),
    				...(this.link_button && { link_button: this.link_button }),
    				...(this.link_text && { link_text: this.link_text }),
    				...(this.link && { link: this.link }),
    				...(this.photo_info && { photo_info: this.photo_info }),
    				...(this.video_url && { video_url: this.video_url }),
    				...(this.video_description && { video_description: this.video_description }),
    				...(text && { text: text }),
    				...(link_button && { link_button: link_button }),
    				...(link_text && { link_text: link_text }),
    				...(link && { link: link }),
    				...(photo_info && { photo_info: photo_info }),
    				...(video_url && { video_url: video_url }),
    				...(video_description && { video_description: video_description }),
    			};

    			try {
    				if (id) {
    					var { status, notification } = await window.axios.put(this.routes.update.replace('ID', id), block);
    				} else {
    					var { status, notification } = await window.axios.post(this.routes.store, block);
    				}

    				if (status) {
    					this.clear();
    					this.getBlocks();
    					this.noty(notification);
    				}
    			} catch (error) {
    				console.table(error.response);
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
    		async move({ id }, where) {
    			let move = {};

    			move['move_' + where] = 1;

    			try {
    				let { notification, status } = await window.axios.put(this.routes.update.replace('ID', id), move);

    				if (status) {
    					this.clear();
    					this.getBlocks();
    					this.noty(notification);
    				}
    			} catch (error) {
    				console.error(error);
    			}
    		},
    		async deleteBlock({ id }) {
    			if (!confirm('Borrar contenido?')) {
    				return false;
    			}

    			this.showSpinner();

    			try {
    				let { notification, status } = await window.axios.delete(this.routes.destroy.replace('ID', id));

    				if (status) {
    					this.clear();
    					this.getBlocks();
    					this.noty(notification);
    				}
    			} catch (error) {
    				console.table(error);
    			}

    			this.hideSpinner();
    		},
    	},

    	mounted() {
    		this.getBlocks();
    		this.listenGlobalEvent('fileAddedToAnInput', this.catchFiles);
    	},
    };
</script>
