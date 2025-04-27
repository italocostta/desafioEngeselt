<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Produtos</h1>
    <Link href="/produtos/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Novo Produto</Link>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2">Nome</th>
          <th class="py-2">Valor</th>
          <th class="py-2">Ações</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="produto in produtos" :key="produto.id" class="text-center">
          <td class="py-2">{{ produto.nome }}</td>
          <td class="py-2">R$ {{ Number(produto.valor).toFixed(2) }}</td>
          <td class="py-2 space-x-2">
            <Link :href="`/produtos/${produto.id}/edit`" class="text-yellow-500">Editar</Link>
            <button @click="destroy(produto.id)" class="text-red-500">Excluir</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  produtos: Array
})

function destroy(id) {
  if (confirm('Deseja realmente excluir este produto?')) {
    Inertia.delete(`/produtos/${id}`)
  }
}
</script>