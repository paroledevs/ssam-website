<template>
	<form @submit.prevent="$parent.save" method="POST">
		
		<div class="input">
			<label>Collection</label>
			<select name="collection" v-model="$parent.collection">
				<option disabled :value="null">Choose collection</option>
				<option v-for="collection in $parent.collections" :key="collection.id" :value="collection.id" >{{ collection.title }}</option>
			</select>
			<div class="focus"></div>
		</div>

		<div class="input" v-if="showCategoriesInput">
			<label>Category</label>
			<select name="collection" v-model="$parent.category">
				<option disabled :value="null">Choose category</option>
				<option v-for="category in $parent.selectedCollection.categories" :key="category.id" :value="category.id" >{{ category.title }}</option>
			</select>
			<div class="focus"></div>
		</div>
		
		
		<div class="fotos" id="product_cover">
			<div class="foto" :style="imgBackground($parent.item.cover)">
				<input type="file" name="product_cover" @change="setImage" accept="image/*" />
				<div class="type">
					<i class="fa fa-image" aria-hidden="true"></i>
					<label>Product main image</label>
				</div>
			</div>
		</div>

		<div class="input">
			<label>Product</label>
			<input type="text" name="title" v-model="$parent.title" placeholder="Product"/>
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Description</label>
			<textarea name="description" v-model="$parent.description" placeholder="Description" rows="12"></textarea>
			<div class="focus"></div>
		</div>

		<div class="input">
			<label>Base Price $</label>
			<input type="text" name="price" v-model.number="$parent.price" placeholder="Base Price $"/>
			<div class="focus"></div>
		</div>
		
		<div class="input check">
			<input type="checkbox" name="is_available" v-model="$parent.is_available" :true-value="1" :false-value="0"/>
			<div class="checkbox">
				<i class="fa fa-check" aria-hidden="true"></i>
			</div>
			<label>Available</label>
		</div>

		<button type="submit">Done</button>
	</form>
</template>

<script>
	export default {
		computed: {
			showCategoriesInput() {
				return this.$parent.selectedCollection && !_.isEmpty(_.get(this.$parent.selectedCollection, 'categories'));
			}
		},
	};
</script>
