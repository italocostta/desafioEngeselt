# Desafio Estágio Web PHP - Marketplace de Confeitarias

Este é o projeto desenvolvido para o **Desafio de Estágio Web** da empresa **Engeselt**. O objetivo é criar um **Marketplace de Confeitarias** utilizando **Laravel**, **Vue.js**, **Inertia.js** e **PostgreSQL**.

---

## 🔢 Tecnologias Utilizadas

- **Backend:** PHP 8.2 + Laravel 10
- **Frontend:** Vue.js 3 + Inertia.js
- **Estilização:** TailwindCSS 3
- **Gerenciador de Pacotes:** Composer (backend) e NPM (frontend)
- **Banco de Dados:** PostgreSQL
- **Ambiente de Desenvolvimento:** Node.js 20.x, Vite 6.x
- **Mapa:** (Ainda não implementado)

---

## 🌿 Funcionalidades Implementadas

- Cadastro, edição, exclusão e listagem de **Confeitarias**.
- Cadastro, edição, exclusão e listagem de **Produtos** vinculados às Confeitarias.
- Upload de **múltiplas imagens** para Produtos.
- Formatação automática de:
  - Telefone (formato (99) 99999-9999)
  - CEP (formato 99999-999)
  - Valor monetário (formato R$ 1.234,56)
- Busca automática de endereço via CEP.
- Relacionamento correto entre Confeitarias e Produtos.
- Exclusão em cascata: ao excluir uma Confeitaria, seus Produtos também são excluídos.
- Layout responsivo e com identidade visual própria para o Marketplace.

---

## 📅 Instalação e Configuração Local

### 1. Clone o Repositório

```bash
https://github.com/italocostta/desafioEngeselt.git
```

### 2. Instale as Dependências

Backend (Laravel):
```bash
composer install
```
Frontend (Vue + Inertia):
```bash
npm install
```

### 3. Configure o Ambiente

- Copie o `.env.example` para `.env`
- Atualize as credenciais de banco de dados PostgreSQL no `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
```

- Gere a chave da aplicação:

```bash
php artisan key:generate
```

### 4. Execute as Migrations

```bash
php artisan migrate
```

### 5. Crie o Link para o Storage (Imagens)

```bash
php artisan storage:link
```

### 6. Inicie os Servidores

Backend:
```bash
php artisan serve
```
Frontend:
```bash
npm run dev
```

Acesse o sistema: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📊 Estrutura de Pastas Relevantes

- **app/Models/**
  - `Confeitaria.php`
  - `Produto.php`
  - `ProdutoImagem.php`
- **app/Http/Controllers/**
  - `ConfeitariaController.php`
  - `ProdutoController.php`
  - `CepController.php`
- **resources/js/Pages/Confeitarias/**
  - `Index.vue`, `Create.vue`, `Edit.vue`, `Show.vue`, `Form.vue`
- **resources/js/Pages/Produtos/**
  - `Index.vue`, `Create.vue`, `Edit.vue`, `Form.vue`
- **resources/js/utils/**
  - `formatters.js`

---

## 🔗 Links Importantes

- [Repositório no GitHub](https://github.com/italocostta/desafioEngeselt)


---

## 🚀 Melhorias Futuras

- ✅ Implementar cadastro de **Latitude e Longitude** para cada Confeitaria.
- ✅ Exibir as Confeitarias no **Mapa Interativo** (Leaflet ou outro).
- ✅ Melhorar gerenciamento de imagens (visualizar, excluir imagens).
- ✅ Implementar testes unitários e e2e (opcional para ganho de pontos extras).

---

> Desenvolvido com dedicação para a seleção de estágio Engeselt! 💜
