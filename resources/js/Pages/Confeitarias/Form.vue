<template>
  <form @submit.prevent="submit" class="space-y-8 max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Nome -->
      <div class="w-full max-w-lg">
        <label class="block text-chocolate font-semibold mb-2">Nome</label>
        <input
          v-model="form.nome"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>

      <!-- Telefone -->
      <div class="w-full max-w-xs">
        <label class="block text-chocolate font-semibold mb-2">Telefone</label>
        <input
          v-model="form.telefone"
          @input="form.telefone = formatarTelefone(form.telefone)"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- CEP -->
      <div class="w-full max-w-xs">
        <label class="block text-chocolate font-semibold mb-2">CEP</label>
        <input
          v-model="form.cep"
          @input="form.cep = formatarCep(form.cep)"
          @blur="buscarCep"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>

      <!-- Estado -->
      <div class="w-full max-w-[120px]">
        <label class="block text-chocolate font-semibold mb-2">Estado</label>
        <input
          v-model="form.estado"
          type="text"
          maxlength="2"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>
    </div>

    <!-- Rua -->
    <div class="w-full max-w-3xl">
      <label class="block text-chocolate font-semibold mb-2">Rua</label>
      <input
        v-model="form.rua"
        type="text"
        class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
        required
      />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Bairro -->
      <div class="w-full max-w-md">
        <label class="block text-chocolate font-semibold mb-2">Bairro</label>
        <input
          v-model="form.bairro"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>

      <!-- Cidade -->
      <div class="w-full max-w-md">
        <label class="block text-chocolate font-semibold mb-2">Cidade</label>
        <input
          v-model="form.cidade"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>
    </div>

    <!-- Botões -->
    <div class="flex justify-end space-x-4 pt-8">
      <Link href="/confeitarias" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg shadow">
        Cancelar
      </Link>
      <button
        type="submit"
        class="bg-primary hover:bg-pink-400 text-white font-semibold px-6 py-2 rounded-lg shadow"
      >
        Salvar
      </button>
    </div>
  </form>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import { useForm } from '@inertiajs/inertia-vue3'
import axios from 'axios'
import { formatarTelefone, formatarCep } from '@/utils/formatters'

const props = defineProps({
  initialData: {
    type: Object,
    default: () => ({})
  }
})

const form = useForm({
  id: props.initialData.id ?? null,
  nome: props.initialData.nome ?? '',
  telefone: props.initialData.telefone ?? '',
  cep: props.initialData.cep ?? '',
  rua: props.initialData.rua ?? '',
  bairro: props.initialData.bairro ?? '',
  cidade: props.initialData.cidade ?? '',
  estado: props.initialData.estado ?? ''
})

function submit() {
  if (form.id) {
    form.put(`/confeitarias/${form.id}`)
  } else {
    form.post('/confeitarias')
  }
}

async function buscarCep() {
  const cepSemMascara = form.cep.replace(/\D/g, '')
  if (cepSemMascara.length === 8) {
    try {
      const response = await axios.get(`/cep/${cepSemMascara}`)
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
