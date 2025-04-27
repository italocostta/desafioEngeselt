<template>
  <div class="p-8 bg-accent min-h-screen">
    <Head title="Nova Confeitaria" />

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
      <h1 class="text-2xl font-bold text-chocolate mb-6">Cadastrar Confeitaria</h1>

      <form @submit.prevent="submit" class="space-y-6">
        <!-- Nome -->
        <div>
          <label class="block text-chocolate font-semibold mb-1">Nome</label>
          <input v-model="form.nome" type="text" class="w-full p-3 border rounded-lg" required />
        </div>

        <!-- Telefone -->
        <div>
          <label class="block text-chocolate font-semibold mb-1">Telefone</label>
          <input v-model="form.telefone" type="text" class="w-full p-3 border rounded-lg" required />
        </div>

        <!-- CEP -->
        <div>
          <label class="block text-chocolate font-semibold mb-1">CEP</label>
          <input
            v-model="form.cep"
            @blur="buscarCep"
            type="text"
            class="w-full p-3 border rounded-lg"
            required
          />
        </div>

        <!-- Rua -->
        <div>
          <label class="block text-chocolate font-semibold mb-1">Rua</label>
          <input v-model="form.rua" type="text" class="w-full p-3 border rounded-lg" required />
        </div>

        <!-- Cidade e Estado -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-chocolate font-semibold mb-1">Cidade</label>
            <input v-model="form.cidade" type="text" class="w-full p-3 border rounded-lg" required />
          </div>
          <div>
            <label class="block text-chocolate font-semibold mb-1">Estado</label>
            <input v-model="form.estado" type="text" class="w-full p-3 border rounded-lg" required />
          </div>
        </div>
      </form>

      <div class="mt-6 flex justify-end space-x-4">
        <Link href="/confeitarias" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg">
          Cancelar
        </Link>
        <button
          type="submit"
          class="bg-primary hover:bg-pink-400 text-white font-semibold px-6 py-2 rounded-lg shadow"
          @click="submit"
        >
          Salvar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios'

const form = useForm({
  nome: '',
  telefone: '',
  cep: '',
  rua: '',
  cidade: '',
  estado: '',
})

function submit() {
  form.post('/confeitarias')
}

async function buscarCep() {
  if (form.cep.length >= 8) {
    try {
      const response = await axios.get(`/cep/${form.cep}`)
      form.rua = response.data.rua ?? ''
      form.bairro = response.data.bairro ?? ''
      form.cidade = response.data.cidade ?? ''
      form.estado = response.data.estado ?? ''
    } catch (error) {
      console.error('Erro ao buscar CEP:', error)
    }
  }
}
</script>
