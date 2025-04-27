<template>
  <div class="p-6">
    <Head :title="confeitaria.nome" />
    <h1 class="text-2xl font-bold mb-4">{{ confeitaria.nome }}</h1>

    <div class="mb-6">
      <p><strong>Telefone:</strong> {{ confeitaria.telefone }}</p>
      <p><strong>Endereço:</strong> {{ confeitaria.rua }}, {{ confeitaria.numero }} - {{ confeitaria.bairro }} - {{ confeitaria.cidade }}/{{ confeitaria.estado }} - CEP: {{ confeitaria.cep }}</p>
    </div>

    <div class="flex space-x-2 mb-6">
      <Link :href="`/confeitarias/${confeitaria.id}/produto/create`" class="bg-green-500 text-white px-4 py-2 rounded">Cadastrar Produto</Link>
      <Link :href="`/confeitarias/${confeitaria.id}/edit`" class="bg-yellow-500 text-white px-4 py-2 rounded">Editar</Link>
      <Link href="/confeitarias" class="bg-gray-500 text-white px-4 py-2 rounded">Voltar</Link>
    </div>

    <h2 class="text-xl font-semibold mb-4">Produtos Cadastrados</h2>

    <div v-if="confeitaria.produtos.length">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="py-2">Nome</th>
            <th class="py-2">Valor</th>
            <th class="py-2">Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="produto in confeitaria.produtos" :key="produto.id" class="text-center">
            <td class="py-2">{{ produto.nome }}</td>
            <td class="py-2">R$ {{ Number(produto.valor).toFixed(2) }}</td>
            <td class="py-2 space-x-2">
              <Link :href="`/produtos/${produto.id}/edit`" class="text-yellow-500">Editar</Link>
              <button @click="destroyProduto(produto.id)" class="text-red-500">Excluir Produto</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-else>
      <p class="text-gray-600">Nenhum produto cadastrado para esta confeitaria.</p>
    </div>
  </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
  confeitaria: Object
})

function destroyProduto(id) {
  if (confirm('Deseja realmente excluir este produto?')) {
    Inertia.delete(`/produtos/${id}`)
  }
}
</script>
