<template>
	<div id="rx">
		<div class="opener" id="opn_menu" @click="openMenu" :class="{show:items}">
			<div class="arrow"></div>
		</div>
		<div class="opener" id="opn_items" @click="openItems" :class="{show:!items}">
			<div class="arrow"></div>
		</div>

		<div class="cerrador" id="cls_menu" @click="closeMenu" :class="{show:menu}"></div>
		<div class="cerrador" id="cls_items" @click="closeItems" :class="{show:items}"></div>
	</div>
</template>

<script>
	export default {
		props: {
			path: {
				default: '',
			},
			onSpaMode: {
				default: false,
			},
		},
		data() {
			return {
				menu: false,
				items: true,
			};
		},

		computed: {},

		methods: {
			openMenu() {
				this.menu = true;
				document.getElementById('dashboardAside').classList.add('show');
			},

			closeMenu() {
				this.menu = false;
				document.getElementById('dashboardAside').classList.remove('show');
			},

			openItems() {
				this.items = true;
				document.getElementById('content').classList.add('show');
			},

			closeItems() {
				this.items = false;
				document.getElementById('content').classList.remove('show');
			},

			init() {
				if (this.path <= 1 || this.onSpaMode) {
					this.openItems();
				} else {
					this.closeItems();
				}
			},
		},

		mounted() {
			this.listenGlobalEvent('openMenu', this.showMenu);
			this.listenGlobalEvent('closeMenu', this.closeMenu);

			this.listenGlobalEvent('openItems', this.openItems);
			this.listenGlobalEvent('closeItems', this.closeItems);

			this.init();
		},
	};
</script>
