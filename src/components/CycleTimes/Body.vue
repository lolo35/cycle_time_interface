<template>
    <div class="flex flex-col">
        <CTForm v-for="ct in $store.state.UpdateCycleTime.cycleTimes" :dataObj="ct" :key="ct.id"></CTForm>
    </div>
</template>

<script>
import CTForm from './CTForm.vue';

export default {
    name: "Body",
    data(){
        return {
            
        }
    },
    components: {
        CTForm,
    }
}
</script>

<style>

</style>