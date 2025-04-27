<template>
  <div class="p-6">
    <Head :title="form.id ? 'Editar Confeitaria' : 'Nova Confeitaria'" />
    <h1 class="text-2xl font-bold mb-4">{{ form.id ? 'Editar Confeitaria' : 'Nova Confeitaria' }}</h1>
    <form @submit.prevent="submit" class="space-y-4">
      <!-- Nome -->
      <div>
        <label class="block font-medium">Nome</label>
        <input v-model="form.nome" type="text" class="border rounded p-2 w-full"/>
        <p v-if="errors.nome" class="text-red-600">{{ errors.nome }}</p>
      </div>
      <!-- Telefone -->
      <div>
        <label class="block font-medium">Telefone</label>
        <input v-model="form.telefone" type="text" class="border rounded p-2 w-full"/>
        <p v-if="errors.telefone" class="text-red-600">{{ errors.telefone }}</p>
      </div>
      <!-- CEP -->
      <div>
        <label class="block font-medium">CEP</label>
        <input v-model="form.cep" @blur="preencherEndereco" type="text" class="border rounded p-2 w-full"/>
        <p v-if="errors.cep" class="text-red-600">{{ errors.cep }}</p>
      </div>
      <!-- Endereço -->
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="block font-medium">Rua</label>
          <input v-model="form.rua" type="text" class="border rounded p-2 w-full"/>
          <p v-if="errors.rua" class="text-red-600">{{ errors.rua }}</p>
        </div>
        <div>
          <label class="block font-medium">Número</label>
          <input v-model="form.numero" type="text" class="border rounded p-2 w-full"/>
          <p v-if="errors.numero" class="text-red-600">{{ errors.numero }}</p>
        </div>
        <div>
          <label class="block font-medium">Bairro</label>
          <input v-model="form.bairro" type="text" class="border rounded p-2 w-full"/>
          <p v-if="errors.bairro" class="text-red-600">{{ errors.bairro }}</p>
        </div>
        <div>
          <label class="block font-medium">Cidade</label>
          <input v-model="form.cidade" type="text" class="border rounded p-2 w-full"/>
          <p v-if="errors.cidade" class="text-red-600">{{ errors.cidade }}</p>
        </div>
        <div class="col-span-2">
          <label class="block font-medium">Estado</label>
          <input v-model="form.estado" type="text" maxlength="2" class="border rounded p-2 w-20"/>
          <p v-if="errors.estado" class="text-red-600">{{ errors.estado }}</p>
        </div>
      </div>
      <!-- Ações -->
      <div class="flex space-x-2">
        <Link :href="route('confeitarias.index')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</Link>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">{{ form.id ? 'Atualizar' : 'Salvar' }}</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { Link, Head, usePage } from '@inertiajs/inertia-vue3'
import { ref } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import { route } from 'ziggy-js'

const props = defineProps({ initialData: Object })
const page = usePage()
const errors = page.props.value.errors || {}
const form = ref({ ...props.initialData })

function preencherEndereco() {
  if (!form.value.cep) return
  fetch(route('cep.show', { cep: form.value.cep }))
    .then(res => {
      if (!res.ok) throw new Error('CEP não encontrado')
      return res.json()
    })
    .then(json => {
      form.value.rua    = json.logradouro || ''
      form.value.bairro = json.bairro    || ''
      form.value.cidade = json.localidade|| ''
      form.value.estado = json.uf         || ''
    })
    .catch(() => {})
}

function submit() {
  if (form.value.id) {
    Inertia.put(
      route('confeitarias.update', { confeitaria: form.value.id }),
      form.value
    )
  } else {
    Inertia.post(
      route('confeitarias.store'),
      form.value
    )
  }
}
</script>
