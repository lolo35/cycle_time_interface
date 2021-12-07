<template>
	<div class="flex flex-col bg-white border px-3 py-1 shadow space-y-2 mb-3">
		<div class="flex flex-row">
			<h5 class="text-lg font-semibold">Editare Cycle Time</h5>
		</div>
		<form class="flex flex-row space-x-3 items-end" @submit="getData()">
			<div class="flex flex-col">
				<label for="line" class="font-semibold text-sm text-gray-600">Linie</label>
				<input type="text" class="px-3 py-1 border rounded" id="line" required v-model="line">
			</div>
			<div class="flex flex-col">
				<label for="part" class="font-semibold text-sm text-gray-600">Part-number</label>
				<input type="text" class="px-3 py-1 border rounded" id="part" required v-model="part">
			</div>
			<button class="bg-blue-500 text-white px-5 py-1 rounded hover:bg-blue-700" type="submit">
				<i class="fas fa-search"></i>
				Cauta
			</button>
		</form>
		<Body v-if="showBody" />
	</div>
	<add-cycle-time></add-cycle-time>
</template>

<script>
// @ is an alias to /src
import axios from 'axios';
import Body from '../components/CycleTimes/Body.vue';
import AddCycleTime from '../components/CycleTimes/AddCycleTime.vue';

export default {
	name: 'Home',
	data(){
		return {
			line: "",
			part: "",
			showBody: false,
		}
	},
	components: {
		Body,
		AddCycleTime,
	},
	methods: {
		async getData(){
			event.preventDefault();
			try {
				const response = await axios.get(`${this.$store.state.url}cycleTime?line_code=L${this.line}&product_code=${this.part}`);
				if(process.env.NODE_ENV === "development"){
					console.log(response.data);
				}
				if(response.data.success){
					this.$store.dispatch('UpdateCycleTime/setCycleTimes', response.data.data);
					this.showBody = true;
				}
			} catch (error){
				if(process.env.NODE_ENV === "development"){
					console.error(error);
				}
			}
		}
	}
}
</script>
