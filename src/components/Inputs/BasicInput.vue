<template>
    <div class="flex flex-col">
        <label for="input" v-if="label"><slot></slot></label>
        <input :type="type" id="input" class="border rounded-sm p-1" :placeholder="placeholder" :value="modelValue" @input="updateInput" :required="required" :step="step">
    </div>
</template>

<script>
export default {
    name: "BasicInput",
    props: {
        type: {
            type: String,
            default: "text",
        },
        placeholder: {
            type: String,
            default: ""
        },
        modelValue: {
            type: String,
            default: "",
        },
        label: {
            type: Boolean,
            default: false,
        },
        required: {
            type: Boolean,
            default: false,
        },
        step: {
            type: String,
            default: "",
        }
    },
    emits: ['update:modelValue'],
    methods: {
        updateInput(event){
            this.$emit('update:modelValue', event.target.value);
        }
    }
}
</script>

<style>

</style>