<template>
	<div id="errorView">
		<div class="content">
			<strong>{{ code }}</strong>
			<span>{{ error }}</span>

			<a href="https://planetoi.de" target="_tab">
				<img src="/images/planetoide_w.svg" />
			</a>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['code', 'error'],
	};
</script>
