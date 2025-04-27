<template>
  <form @submit.prevent="submit" class="space-y-8 max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Nome do Produto -->
      <div class="w-full max-w-lg">
        <label class="block text-chocolate font-semibold mb-2">Nome do Produto</label>
        <input
          v-model="form.nome"
          type="text"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>

      <!-- Valor -->
      <div class="w-full max-w-xs">
        <label class="block text-chocolate font-semibold mb-2">Valor (R$)</label>
        <input
          v-model="form.valor"
          type="number"
          step="0.01"
          min="0"
          placeholder="0.00"
          class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
          required
        />
      </div>
    </div>

    <!-- Descrição -->
    <div class="w-full">
      <label class="block text-chocolate font-semibold mb-2">Descrição</label>
      <textarea
        v-model="form.descricao"
        class="w-full p-3 border border-secondary rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"
        rows="4"
      ></textarea>
    </div>

    <!-- Upload de Imagens -->
    <div class="w-full">
      <label class="block text-chocolate font-semibold mb-2">Imagens</label>
      <input
        type="file"
        @change="handleFileChange"
        multiple
        class="w-full p-3 border border-secondary rounded-lg bg-white text-chocolate focus:outline-none focus:ring-2 focus:ring-primary"
      />
    </div>

    <!-- Botões -->
    <div class="flex justify-end space-x-4 pt-8">
      <Link :href="`/confeitarias/${form.confeitaria_id}`" class="bg-gray-400 hover:bg-gray-500 text-white px-6 py-2 rounded-lg shadow">
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

const props = defineProps({
  initialData: {
    type: Object,
    default: () => ({})
  },
  confeitariaId: Number
})

const form = useForm({
  id: props.initialData.id ?? null,
  confeitaria_id: props.initialData.confeitaria_id ?? props.confeitariaId,
  nome: props.initialData.nome ?? '',
  valor: props.initialData.valor ?? '',
  descricao: props.initialData.descricao ?? '',
  imagens: [] // Upload de imagens
})

function submit() {
  const payload = new FormData()
  payload.append('confeitaria_id', form.confeitaria_id)
  payload.append('nome', form.nome)
  payload.append('valor', form.valor)
  payload.append('descricao', form.descricao)

  for (let i = 0; i < form.imagens.length; i++) {
    payload.append('imagens[]', form.imagens[i])
  }

  if (form.id) {
    form.post(`/produtos/${form.id}`, {
      _method: 'put',
      preserveScroll: true,
      data: payload
    })
  } else {
    form.post('/produtos', {
      preserveScroll: true,
      data: payload
    })
  }
}

function handleFileChange(e) {
  form.imagens = e.target.files
}
</script>
