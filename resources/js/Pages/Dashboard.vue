<template>
    <AppLayout title="Form">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Form Trigger
            </h2>
        </template>
      <NotificationForm/>
    </AppLayout>
</template>
<script setup>
import NotificationForm from '@/Components/Form/NotificationForm.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
