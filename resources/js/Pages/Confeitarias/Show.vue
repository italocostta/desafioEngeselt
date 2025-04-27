<template>
  <div class="p-6">
    <Head :title="confeitaria.nome" />
    <h1 class="text-2xl font-bold mb-4">{{ confeitaria.nome }}</h1>
    <div class="mb-6">
      <p><strong>Telefone:</strong> {{ confeitaria.telefone }}</p>
      <p>
        <strong>Endereço:</strong>
        {{ confeitaria.cep }}, {{ confeitaria.rua }}, {{ confeitaria.numero }},
        {{ confeitaria.bairro }}, {{ confeitaria.cidade }}-{{ confeitaria.estado }}
      </p>
    </div>
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-xl font-semibold">Produtos</h2>
      <Link :href="`/confeitarias/${confeitaria.id}/produtos/create`" class="bg-green-500 text-white px-4 py-2 rounded">Novo Produto</Link>
    </div>
    <ul>
      <li v-for="produto in confeitaria.produtos" :key="produto.id" class="border rounded p-4 mb-2 flex justify-between items-center">
        <div>
          <p class="font-medium">{{ produto.nome }}</p>
          <p>R$ {{ produto.valor.toFixed(2) }}</p>
        </div>
        <div class="flex space-x-2">
          <Link :href="`/produtos/${produto.id}`" class="text-blue-500">Ver</Link>
          <Link :href="`/produtos/${produto.id}/edit`" class="text-yellow-500">Editar</Link>
          <button @click="destroy(produto.id)" class="text-red-500">Excluir</button>
        </div>
      </li>
      <li v-if="confeitaria.produtos.length === 0" class="py-4">Nenhum produto cadastrado.</li>
    </ul>
    <div class="mt-6">
      <Link href="/confeitarias" class="text-gray-500">Voltar às Confeitarias</Link>
    </div>
  </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  confeitaria: Object,
})

function destroy(id) {
  if (confirm('Deseja realmente excluir este produto?')) {
    Inertia.delete(`/produtos/${id}`)
  }
}
</script>