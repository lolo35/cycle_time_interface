<template>
    <div class="flex flex-col bg-white border px-3 py-1 shadow space-y-2 mb-3">
        <div class="flex flex-row">
            <h5 class="text-lg font-semibold">Adaugare Cycle Time</h5>
        </div>
        <form class="flex flex-row space-x-2 items-end" @submit="setCycleTime()">
            <basic-input :label="true" :type="'text'" :required="true" v-model="line">
                <p class="text-sm font-semibold text-gray-600 italic">
                    <i class="fas fa-grip-lines-vertical text-blue-500"></i>
                    Line
                </p>
            </basic-input>
             <basic-input :label="true" :type="'text'" :required="true" v-model="part">
                <p class="text-sm font-semibold text-gray-600 italic">
                    <i class="fas fa-cog text-blue-500"></i>
                    Part-number
                </p>
            </basic-input>
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
            <basic-input :label="true" :type="'number'" :required="true" v-model="planRate">
                <p class="text-sm font-semibold text-gray-600 italic">
                <i class="fas fa-percent text-blue-500"></i>
                    Planning rate percentage
                </p>
            </basic-input>
            <button type="submit" class="bg-blue-500 text-white rounded-sm px-9 py-1 hover:bg-blue-700">Submit</button>
        </form>
    </div>
</template>

<script>
import BasicInput from '../Inputs/BasicInput.vue';
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "AddCycleTime",
    data(){
        return {
            ct: "",
            line: "",
            part: "",
            opCount: "",
            mppp: "",
            planRate: "",
        }
    },
    components: {
        BasicInput,
    },
    methods: {
        async setCycleTime(){
            event.preventDefault();
            let formData = new FormData();
            formData.append('cycle_time', this.ct);
            formData.append('line', `L${this.line}`);
            formData.append('part', this.part);
            formData.append('op_count', this.opCount);
            formData.append('max_parts', this.mppp);
            formData.append('plan_rate', this.planRate);
            //formData.append('dispatch_id', this.data.dispatch_id);
            //formData.append('row_id', this.data.id);
            try {
                const response = await axios.post(`${this.$store.state.url}setCycleTimeForPart`, formData, { headers: { "Content-type": "application/x-www-form-urlencoded"}});
                if(process.env.NODE_ENV === "development"){
                    console.log(response.data);
                }
                if(response.data.success){
                    Swal.fire({
                        icon: 'success',
                        text: 'Modificarile au fost salvate',
                        timer: 5000,
                        showConfirmButton: false,
                        position: 'top-end',
                    });
                    this.ct = "";
                    this.line = "";
                    this.part = "";
                    this.opCount = "";
                    this.mppp = "";
                    this.planRate = "";
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