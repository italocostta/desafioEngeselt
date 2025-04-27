<template>
    <div class="p-6">

        <Head title="Confeitarias" />
        <h1 class="text-2xl font-bold mb-4">Confeitarias</h1>
        <Link href="/confeitarias/create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Nova
        Confeitaria</Link>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Nome</th>
                    <th class="py-2">Telefone</th>
                    <th class="py-2">Cidade</th>
                    <th class="py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="confeitaria in confeitarias" :key="confeitaria.id" class="text-center">
                    <td class="py-2">{{ confeitaria.nome }}</td>
                    <td class="py-2">{{ confeitaria.telefone }}</td>
                    <td class="py-2">{{ confeitaria.cidade }}</td>
                    <td class="py-2">
                        <Link :href="`/confeitarias/${confeitaria.id}`" class="text-blue-500">Ver</Link>
                        <Link :href="`/confeitarias/${confeitaria.id}/edit`" class="ml-2 text-yellow-500">Editar</Link>
                        <button @click="destroyConfeitaria" class="bg-red-500 text-white px-4 py-2 rounded">Excluir Confeitaria</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { Link, Head } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'

const props = defineProps({
    confeitarias: Array
})

function destroyConfeitaria() {
  if (confirm('Deseja realmente excluir esta confeitaria?')) {
    Inertia.delete(`/confeitarias/${confeitaria.id}`)
  }
}
</script>