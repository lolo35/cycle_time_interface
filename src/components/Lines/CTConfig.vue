<template>
    <form @submit="setCycleTime()">
        <div class="flex flex-row space-x-2 items-end">
            <i class="fas fa-check-circle text-green-500 mb-2" v-if="ctSet"></i>
            <basic-input :label="true" :type="'number'" :required="true" v-model="ct" :step="'0.0001'">
                <p class="text-sm font-semibold text-gray-600 italic">
                    <i class="fas fa-history text-blue-500"></i>
                    Cycle time in seconds
                </p>
            </basic-input>
            <basic-input :label="true" :type="'number'" :required="true" v-model="opCount">
                <p class="text-sm font-semibold text-gray-600 italic">
                    <i class="fas fa-users text-blue-500"></i>
                    Operator count
                </p>
            </basic-input>
            <basic-input :label="true" :type="'number'" v-model="mppp">
                <p class="text-sm font-semibold text-gray-600 italic">
                    <i class="fas fa-cogs text-blue-500"></i>
                    Max parts per pitch
                </p>
            </basic-input>
            <basic-input :label="true" :type="'number'" :required="true" v-model="prp">
                <p class="text-sm font-semibold text-gray-600 italic">
                   <i class="fas fa-percent text-blue-500"></i>
                    Planning rate percentage
                </p>
            </basic-input>
            <button type="submit" class="bg-blue-500 text-white rounded-sm px-9 py-1 hover:bg-blue-700">Submit</button>
        </div>
    </form>
</template>

<script>
import axios from 'axios';
import BasicInput from '../Inputs/BasicInput.vue';

export default {
    name: "CTConfig",
    data(){
        return {
            ct: "",
            opCount: "",
            mppp: "",
            prp: "",
            ctSet: false,
        }
    },
    props: {
        data: Object,
    },
    components: {
        BasicInput,
    },
    methods: {
        async setCycleTime(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('cycle_time', this.ct);
            formData.append('line', this.data.line);
            formData.append('part', this.data.part);
            formData.append('op_count', this.opCount);
            formData.append('max_parts', this.mppp);
            formData.append('plan_rate', this.prp);
            formData.append('dispatch_id', this.data.dispatch_id);
            formData.append('row_id', this.data.id);
            try {
                const response = await axios.post(`${this.$store.state.url}setCycleTimeForPart`, formData, { headers: { "Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    this.ctSet = true;
                }
            } catch (error) {
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