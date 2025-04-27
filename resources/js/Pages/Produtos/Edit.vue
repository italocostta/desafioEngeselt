<template>
  <div class="p-8 bg-accent min-h-screen">
    <Head title="Editar Produto" />

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
      <h1 class="text-2xl font-bold text-chocolate mb-6">Editar Produto</h1>

      <Form :initial-data="initialData" />
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import Form from './Form.vue'

// Props vindo da Inertia
const props = defineProps({
  initialData: Object
})
</script>
