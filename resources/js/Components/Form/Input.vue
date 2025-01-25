<template>
    <div class="my-4">
        <InputLabel :value="label" />
        <div class="mt-4">
            <slot></slot>
        </div>
        <TextInput
            id="Name"
            v-model="model"
            :type
            class="mt-1 block w-full"
            :required
            v-if="input"
            v-bind="$attrs"
        />
        <InputError class="mt-2 h-1" :message="errorMessage" />
    </div>
</template>
<script setup>
import InputLabel from "../InputLabel.vue";
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
defineProps({
    type: { default: "text" },
    label: { default: "" },
    required: { default: false },
    input: { default: true },
    errorMessage:{default:''}
});
const model = defineModel({ default: "" });
</script>
