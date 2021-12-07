<template>
    <div class="flex flex-col">
        <menu-bar>
            <div class="flex flex-row items-center justify-between px-3 py-1 w-full">
                <div class="text-gray-300 font-semibold">{{ amg }}</div>
                <div>
                    <basic-input :placeholder="'Cautare...'" v-model="searchTerm"></basic-input>
                </div>
            </div>
        </menu-bar>
        <div v-if="showLines">
            <individual-lines
                v-for="(line, index) in lines"
                :key="line.id"
                :data="line"
                :index="index"
            ></individual-lines>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import MenuBar from '../components/MenuBar.vue';
import BasicInput from '../components/Inputs/BasicInput.vue';
import IndividualLines from '../components/Lines/IndividualLines.vue';

export default {
    name: "AMG1",
    data(){
        return {
            amg: "AMG1",
            searchTerm: "",
            lines: Array,
            showLines: false,
        }
    },
    components: {
        MenuBar,
        BasicInput,
        IndividualLines,
    },
    created(){
        this.fetchLines();
    },
    methods: {
        async fetchLines(){
            try {
                const response = await axios.get(`${this.$store.state.url}noCTAMG?amg=${this.amg}`);
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.lines = response.data.data;
                    this.showLines = true;
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