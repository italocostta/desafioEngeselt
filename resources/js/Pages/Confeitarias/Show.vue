<template>
  <div class="p-8 bg-accent min-h-screen">
    <Head title="Detalhes da Confeitaria" />

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-chocolate">{{ confeitaria.nome }}</h1>
      <div class="space-x-2">
        <Link :href="`/confeitarias/${confeitaria.id}/edit`" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-4 py-2 rounded-lg shadow">
          Editar Confeitaria
        </Link>
        <button @click="destroyConfeitaria(confeitaria.id)" class="bg-red-400 hover:bg-red-500 text-white font-semibold px-4 py-2 rounded-lg shadow">
          Excluir
        </button>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6 mb-8">
      <p class="text-lg text-chocolate mb-2"><strong>Telefone:</strong> {{ formatarTelefone(confeitaria.telefone) }}</p>
      <p class="text-lg text-chocolate mb-2">
        <strong>Endereço:</strong>
        {{ confeitaria.rua }}, - {{ confeitaria.bairro }},
        {{ confeitaria.cidade }}/{{ confeitaria.estado }} - CEP: {{ formatarCep(confeitaria.cep) }}
      </p>
    </div>

    <div class="flex flex-wrap justify-between items-center mb-8 gap-4">
      <Link
        href="/confeitarias"
        class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg shadow"
      >
        Voltar para Confeitarias
      </Link>

      <Link
        :href="`/confeitarias/${confeitaria.id}/produto/create`"
        class="bg-primary hover:bg-pink-400 text-white font-semibold px-6 py-2 rounded-lg shadow"
      >
        Novo Produto
      </Link>
    </div>

    <div v-if="produtos && produtos.length" class="bg-white rounded-lg shadow overflow-x-auto">
      <table class="min-w-full divide-y divide-secondary">
        <thead class="bg-secondary text-chocolate">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nome</th>
            <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Valor</th>
            <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Ações</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-secondary">
          <tr v-for="produto in produtos" :key="produto.id" class="hover:bg-secondary transition">
            <td class="px-6 py-4">{{ produto.nome }}</td>
            <td class="px-6 py-4">R$ {{ Number(produto.valor).toFixed(2) }}</td>
            <td class="px-6 py-4 flex justify-center space-x-2">
              <Link :href="`/produtos/${produto.id}/edit`" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm">
                Editar
              </Link>
              <button @click="destroyProduto(produto.id)" class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm">
                Excluir
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-center text-chocolate mt-10">
      Nenhum produto cadastrado ainda.
    </div>

  </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import { formatarTelefone, formatarCep, formatarMoeda } from '@/utils/formatters'

const props = defineProps({
  confeitaria: Object,
  produtos: {
    type: Array,
    default: () => []
  }
})

function destroyConfeitaria(id) {
  if (confirm('Deseja realmente excluir esta confeitaria?')) {
    Inertia.delete(`/confeitarias/${id}`)
  }
}

function destroyProduto(id) {
  if (confirm('Deseja realmente excluir este produto?')) {
    Inertia.delete(`/produtos/${id}`)
  }
}
</script>
