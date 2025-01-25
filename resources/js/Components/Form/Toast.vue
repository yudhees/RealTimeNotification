<template>
    <div class="flex items-center">
        <div class="relative inline-block shrink-0">
            <img class="w-12 h-12 rounded-full" :src="user.profile_photo_url"
                alt="Jese Leos image" />
        </div>
        <div class="ms-3 text-sm font-normal">
            <div class="text-sm font-semibold text-gray-900">
                {{ user.name }}
            </div>
            <div class="text-sm font-normal">Your Form Submitted Successfully
                <a :href="getRoute()" class="text-decoration-line text-blue-600" target="_blank">Click Here </a>to View Data
            </div>
        </div>
    </div>
</template>
<script setup>
import { usePage } from '@inertiajs/vue3';
const props=defineProps(['data'])
const prop=usePage().props
const user=prop.auth.user
const getRoute=()=>{
    return route('form-view',props.data.id)
}
</script>
