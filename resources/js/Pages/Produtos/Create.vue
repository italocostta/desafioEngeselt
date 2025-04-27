<template>
  <div class="p-8 bg-accent min-h-screen">
    <Head title="Novo Produto" />

    <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow">
      <h1 class="text-2xl font-bold text-chocolate mb-6">Cadastrar Novo Produto</h1>

      <Form :initial-data="{}" :confeitaria-id="confeitariaId" />
    </div>
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/inertia-vue3'
import Form from './Form.vue'

// Props vindo da rota
const props = defineProps({
  confeitariaId: Number
})
</script>
