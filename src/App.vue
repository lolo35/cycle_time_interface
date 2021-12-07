<template>
	<Navbar />	
	<div class="flex w-full h-screen">
		<Sidebar />
		<section class="w-full p-4 overflow-scroll">
			<router-view/>
		</section>
	</div>
</template>

<script>
import Navbar from './components/Navigation/Navbar.vue';
import Sidebar from './components/Navigation/Sidebar.vue';

export default {
	name: "App",
	data(){
		return {

		}
	},
	components: {
		Navbar,
		Sidebar,
	},
	created(){
		this.fetchEnv();
	},
	methods: {
		fetchEnv(){
			if(process.env.NODE_ENV === "development"){
				this.$store.dispatch('setUrl', "http://localhost/lumen/ct_api/");
			}else{
				this.$store.dispatch('setUrl', "http://artl-app04/ctInt/api/public/");
			}
		}
	}
}
</script>

<style>

</style>
