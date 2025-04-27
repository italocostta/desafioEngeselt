<template>
    <form @submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block font-medium">Nome</label>
            <input v-model="form.nome" type="text" class="border rounded p-2 w-full" />
            <p v-if="errors.nome" class="text-red-600">{{ errors.nome }}</p>
        </div>
        <div>
            <label class="block font-medium">Telefone</label>
            <input v-model="form.telefone" type="text" class="border rounded p-2 w-full" />
            <p v-if="errors.telefone" class="text-red-600">{{ errors.telefone }}</p>
        </div>
        <div>
            <label class="block font-medium">CEP</label>
            <input v-model="form.cep" @blur="preencherEndereco" type="text" class="border rounded p-2 w-full" />
            <p v-if="errors.cep" class="text-red-600">{{ errors.cep }}</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-medium">Rua</label>
                <input v-model="form.rua" type="text" class="border rounded p-2 w-full" />
                <p v-if="errors.rua" class="text-red-600">{{ errors.rua }}</p>
            </div>
            <div>
                <label class="block font-medium">Número</label>
                <input v-model="form.numero" type="text" class="border rounded p-2 w-full" />
                <p v-if="errors.numero" class="text-red-600">{{ errors.numero }}</p>
            </div>
            <div>
                <label class="block font-medium">Bairro</label>
                <input v-model="form.bairro" type="text" class="border rounded p-2 w-full" />
                <p v-if="errors.bairro" class="text-red-600">{{ errors.bairro }}</p>
            </div>
            <div>
                <label class="block font-medium">Cidade</label>
                <input v-model="form.cidade" type="text" class="border rounded p-2 w-full" />
                <p v-if="errors.cidade" class="text-red-600">{{ errors.cidade }}</p>
            </div>
            <div class="col-span-2">
                <label class="block font-medium">Estado</label>
                <input v-model="form.estado" maxlength="2" type="text" class="border rounded p-2 w-20" />
                <p v-if="errors.estado" class="text-red-600">{{ errors.estado }}</p>
            </div>
        </div>

        <div class="flex space-x-2">
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

const form = ref({
    nome: '',
    telefone: '',
    cep: '',
    rua: '',
    numero: '',
    bairro: '',
    cidade: '',
    estado: '',
    ...props.initialData
})

const page = usePage()
const errors = page.props.value.errors || {}

function preencherEndereco() {
    if (!form.value.cep) return
    fetch(`/cep/${form.value.cep}`)
        .then(res => res.json())
        .then(json => {
            if (!json.error) {
                form.value.rua = json.logradouro || ''
                form.value.bairro = json.bairro || ''
                form.value.cidade = json.localidade || ''
                form.value.estado = json.uf || ''
            }
        })
        .catch(() => { })
}

function submit() {
    if (form.value.id) {
        Inertia.put(`/confeitarias/${form.value.id}`, form.value)
    } else {
        Inertia.post('/confeitarias', form.value)
    }
}
</script>