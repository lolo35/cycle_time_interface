<template>
    <form class="flex flex-col bg-white shadow rounded border px-3 py-1 mt-2" v-if="!closed">
        <div class="flex flex-row items-center justify-between">
            <h3 class="text-lg text-gray-500 font-bold">{{ data.line }} - {{ data.part }}</h3>
            <input type="number" class="border w-10 p-1" v-model="nrOfConfigs">
        </div>
        <CTConfig :data="data" v-for="n in nrOfConfigs" :key="n"></CTConfig>
        <div class="flex flex-row w-full">
            <button class="bg-green-500 hover:bg-green-700 text-white w-full mt-5 px-3 py-1 rounded-sm" @click="closeDispatch()">Close Dispatch</button>
        </div>
    </form>
</template>

<script>
import CTConfig from './CTConfig.vue';
import axios from 'axios';

export default {
    name: "IndividualLines",
    data(){
        return {
            nrOfConfigs: 1,
            closed: false,
        }
    },
    props: {
        data: Object,
        index: Number,
    },
    components: {
        CTConfig,
    },
    emits: ['deleteLine'],
    methods: {
        async closeDispatch(){
            try {
                let formData = new FormData();
                formData.append('dispatch_id', this.data.dispatch_id);
                const response = await axios.post(`${this.$store.state.url}closeDispatch`, formData, { headers: {"Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.closed = true;
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

<style>

</style>