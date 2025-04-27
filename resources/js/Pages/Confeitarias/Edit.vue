<template>
    <div class="p-6">

        <Head title="Editar Confeitaria" />
        <h1 class="text-2xl font-bold mb-4">Editar Confeitaria</h1>
        <Form :initialData="confeitaria" />
    </div>
</template>

<script setup>
import Form from './Form.vue'
import { Head } from '@inertiajs/inertia-vue3'

const props = defineProps({
    confeitaria: Object
})
</script>