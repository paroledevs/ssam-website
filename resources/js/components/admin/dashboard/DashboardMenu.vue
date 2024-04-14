<template>
	<menu>
		<div class="op_menu" :class="{ active: item.active }" v-for="(item, index) in items" :key="index">
			<a :href="item.link"></a>
			<div class="centro">
				<i :class="item.icon"></i>
				<span>{{ item.title }}</span>
			</div>
			<div class="light"></div>
		</div>

		<div class="op_menu">
			<a @click.prevent="logoutAdmin"></a>
			<div class="centro">
				<i class="icon-key"></i>
				<span>SALIR</span>
			</div>
			<div class="light"></div>

			<slot name="csrf"></slot>
		</div>
	</menu>
</template>
<script>
	export default {
		props: ['items'],
		methods: {
			logoutAdmin(event) {
				document.getElementById('logout-form-component').submit();
			},
		},
	};
</script>
