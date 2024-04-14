<template>

	<div id="planetoide" :class="{temp : temp}">

		<div class="blurcolor"></div>

		<div class="logo">
			<a href="https://planetoi.de" target="_tab">
		   		<img src="/images/planetoide_w.svg">
			</a>
		</div>
		

	</div>

</template>

<script>
	export default {
		props: ['temp'],
	}
</script>


