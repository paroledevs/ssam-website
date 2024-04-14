<template>
	<div id="actions" v-if="tools" :class="{ wiped: wiped }">
		<button class="state" @click="showActions">
			<i class="icon-cog"></i>
		</button>

		<div id="hidden_actions">
			<div class="action" id="showOnSite" v-if="showShow" @click="liveViewItem(onSpaMode)">
				<i class="icon-desktop"></i>
			</div>

			<div class="action" id="delete" @click="deleteItem(onSpaMode)" v-if="showDelete">
				<i class="icon-trash"></i>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: {
			onSpaMode: {
				default: false,
			},
		},
		data() {
			return {
				tools: true,
				showDelete: true,
				showShow: true,
				actions: 0,
				wiped: false,
			};
		},

		methods: {
			showActions(event) {
				this.actions = 0;

				if (this.showDelete) {
					this.actions += 1;
				}
				if (this.showShow) {
					this.actions += 1;
				}

				var width = this.actions * 60 + 'px';

				if (!this.wiped) {
					this.wiped = true;
					document.getElementById('viewsbar').setAttribute("style", "transform: translateX(-" + width + ")");
				} else {
					this.wiped = false;
					document.getElementById('viewsbar').setAttribute("style", "transform: translateX(-0px)");
				}
			},

			hideTools() {
				this.tools = false;
			},

			showTools() {
				this.tools = true;
			},

			hideDelete() {
				this.showDelete = false;
			},

			hideShow() {
				this.showShow = false;
			},
		},

		mounted() {
			this.listenGlobalEvent('hideActions', this.hideTools);
			this.listenGlobalEvent('showActions', this.showTools);
			this.listenGlobalEvent('hideActionDelete', this.hideDelete);
			this.listenGlobalEvent('hideActionShow', this.hideShow);
		},
	};
</script>
