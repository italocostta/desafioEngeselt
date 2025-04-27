<template>
    <div class="p-8 bg-accent min-h-screen">
      <Head title="Confeitarias" />
  
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-chocolate">Gerenciar Confeitarias</h1>
        <Link href="/confeitarias/create" class="bg-primary hover:bg-pink-400 text-white font-semibold px-6 py-2 rounded-lg shadow">
          Nova Confeitaria
        </Link>
      </div>
  
      <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-secondary">
          <thead class="bg-secondary text-chocolate">
            <tr>
              <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Nome</th>
              <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Telefone</th>
              <th class="px-6 py-3 text-left text-sm font-semibold uppercase tracking-wider">Cidade</th>
              <th class="px-6 py-3 text-center text-sm font-semibold uppercase tracking-wider">Ações</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-secondary">
            <tr v-for="confeitaria in confeitarias" :key="confeitaria.id" class="hover:bg-secondary transition">
              <td class="px-6 py-4">{{ confeitaria.nome }}</td>
              <td class="px-6 py-4">{{ formatarTelefone(confeitaria.telefone) }}</td>
              <td class="px-6 py-4">{{ confeitaria.cidade }}</td>
              <td class="px-6 py-4 flex justify-center space-x-2">
                <Link :href="`/confeitarias/${confeitaria.id}`" class="bg-green-400 hover:bg-green-500 text-white px-4 py-2 rounded-lg text-sm">
                  Ver
                </Link>
                <Link :href="`/confeitarias/${confeitaria.id}/edit`" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm">
                  Editar
                </Link>
                <button @click="destroy(confeitaria.id)" class="bg-red-400 hover:bg-red-500 text-white px-4 py-2 rounded-lg text-sm">
                  Excluir
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link, Head } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'
  import { formatarTelefone, formatarCep, formatarMoeda } from '@/utils/formatters'

  
  const props = defineProps({
    confeitarias: Array
  })
  
  function destroy(id) {
    if (confirm('Deseja realmente excluir esta confeitaria?')) {
      Inertia.delete(`/confeitarias/${id}`)
    }
  }
  </script>
  