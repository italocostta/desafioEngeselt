import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import '../css/app.css';

// Aqui o Vite “globa” todas as páginas .vue em ./Pages
const pages = import.meta.glob('./Pages/**/*.vue')

createInertiaApp({
  resolve: name => {
    const importPage = pages[`./Pages/${name}.vue`]
    if (!importPage) {
      throw new Error(`Página "${name}" não encontrada em ./Pages`)
    }
    return importPage() // retorna a Promise de importação
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el)
  },
})

InertiaProgress.init()
