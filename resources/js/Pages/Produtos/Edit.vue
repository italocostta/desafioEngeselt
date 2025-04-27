<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Editar Produto</h1>
    <Form :initial-data="initialData" />
  </div>
</template>

<script setup>
import Form from './Form.vue'

const props = defineProps({
  initialData: Object
})
</script>