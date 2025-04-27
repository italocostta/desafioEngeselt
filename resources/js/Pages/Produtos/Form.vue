<template>
    <form @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block font-medium">Nome</label>
        <input v-model="form.nome" type="text" class="border rounded p-2 w-full" />
        <p v-if="errors.nome" class="text-red-600">{{ errors.nome }}</p>
      </div>
  
      <div>
        <label class="block font-medium">Valor</label>
        <input v-model="form.valor" type="number" step="0.01" class="border rounded p-2 w-full" />
        <p v-if="errors.valor" class="text-red-600">{{ errors.valor }}</p>
      </div>
  
      <div>
        <label class="block font-medium">Descrição</label>
        <textarea v-model="form.descricao" class="border rounded p-2 w-full"></textarea>
        <p v-if="errors.descricao" class="text-red-600">{{ errors.descricao }}</p>
      </div>
  
      <div>
        <label class="block font-medium">Imagens</label>
        <input @change="handleFiles" type="file" multiple class="border rounded p-2 w-full" />
        <p v-if="errors['imagens.0']" class="text-red-600">{{ errors['imagens.0'] }}</p>
      </div>
  
      <div v-if="form.imagens?.length" class="grid grid-cols-2 gap-4 mt-4">
        <div v-for="imagem in form.imagens" :key="imagem.id" class="border p-2 rounded">
          <img :src="`/storage/${imagem.caminho}`" class="w-full h-40 object-cover rounded" />
        </div>
      </div>
  
      <div class="flex space-x-2 mt-4">
        <Link href="/confeitarias" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</Link>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Salvar</button>
      </div>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import { Link, usePage } from '@inertiajs/inertia-vue3'
  import { Inertia } from '@inertiajs/inertia'
  
  const props = defineProps({
    initialData: Object
  })
  
  const page = usePage()
  const errors = page.props.value.errors || {}
  
  const form = ref({
    nome: '',
    valor: '',
    descricao: '',
    confeitaria_id: '',
    imagens: [],
    ...props.initialData
  })
  
  const imagens = ref([])
  
  function handleFiles(event) {
    imagens.value = Array.from(event.target.files)
  }
  
  function submit() {
    const payload = new FormData()
    for (const key in form.value) {
      if (key !== 'imagens') {
        payload.append(key, form.value[key])
      }
    }
    imagens.value.forEach(file => {
      payload.append('imagens[]', file)
    })
  
    if (form.value.id) {
      Inertia.post(`/produtos/${form.value.id}`, payload, { method: 'post' })
    } else {
      Inertia.post('/produtos', payload)
    }
  }
  </script>
  