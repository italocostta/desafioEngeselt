<template>
  <div class="p-6">
    <Head title="Confeitarias" />
    <h1 class="text-2xl font-bold mb-4">Confeitarias</h1>
    <Link :href="route('confeitarias.create')" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
      Nova Confeitaria
    </Link>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2">Nome</th>
          <th class="py-2">CEP</th>
          <th class="py-2">Cidade</th>
          <th class="py-2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="confeitaria in confeitarias" :key="confeitaria.id" class="text-center">
          <td class="py-2">{{ confeitaria.nome }}</td>
          <td class="py-2">{{ confeitaria.cep }}</td>
          <td class="py-2">{{ confeitaria.cidade }}</td>
          <td class="py-2">
            <Link :href="route('confeitarias.show', { confeitaria: confeitaria.id })" class="text-blue-500">Ver</Link>
            <Link :href="route('confeitarias.edit', { confeitaria: confeitaria.id })" class="ml-2 text-yellow-500">Editar</Link>
            <button @click="destroy(confeitaria.id)" class="ml-2 text-red-500">Excluir</button>
          </td>
        </tr>
        <tr v-if="confeitarias.length === 0">
          <td colspan="4" class="py-4">Nenhuma confeitaria cadastrada.</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { route } from 'ziggy-js'

const props = defineProps({
  confeitarias: Array,
})

function destroy(id) {
  if (confirm('Deseja realmente excluir esta confeitaria?')) {
    Inertia.delete(
      route('confeitarias.destroy', { confeitaria: id })
    )
  }
}
</script>