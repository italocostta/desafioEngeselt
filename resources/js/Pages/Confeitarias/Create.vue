<template>
    <div class="p-6">

        <Head title="Nova Confeitaria" />
        <h1 class="text-2xl font-bold mb-4">Nova Confeitaria</h1>
        <Form :initialData="{}" />
    </div>
</template>

<script setup>
import Form from './Form.vue'
import { Head } from '@inertiajs/inertia-vue3'
</script>