# Xavier Solutions - Sistema de Gestão de Conteúdo (PHP)

🚧 Projeto em desenvolvimento | Foco em aprendizado de estruturação, componentes e navegação em PHP sem frameworks

## 🎯 Objetivo

Criar um sistema web simples com funcionalidades de **listagem**, **cadastro** e **edição** de:

- Artigos
- Categorias
- Usuários

> Os dados são mockados em arrays (sem uso de banco de dados) e utilizados para simular interações com o sistema.

---

## 🛠️ Tecnologias e Conceitos Aplicados

- PHP puro (sem frameworks)
- Componentização de layouts (Header, Footer, Sidebar, etc.)
- Organização de rotas e pastas
- Arrays como fonte de dados estáticos
- Navegação entre telas (simulação de CRUD)
- Caminhos absolutos e relativos para arquivos (JS, CSS, imagens)

---

## 🗂️ Estrutura de Dados Simulada

### Artigos
- `id`
- `titulo`
- `conteudo`
- `categoria_id` (relaciona com `categorias`)
- `usuario_id` (relaciona com `usuarios`)

### Categorias
- `id`
- `nome`

### Usuários
- `id`
- `nome`
- `email`
- `cpf`
- `nascimento`

---

## 🔍 O que está implementado

- [x] Tela inicial com navegação
- [x] Listagem de artigos, categorias e usuários com dados estáticos
- [x] Cadastro e edição simulados (com exibição e preenchimento)
- [x] Separação de arquivos e pastas por entidade
- [x] Uso de componentes PHP para reuso de código
- [x] Organização de caminhos para evitar problemas com imagens, CSS e JS

---

## ✨ Plano de Evolução

- Integração com banco de dados MySQL
- Validações de formulários
- Filtros de busca e ordenação
- Login e controle de acesso
- Interface com design responsivo

---

## 💬 Sobre mim

Sou Wellington Xavier, estudante de Desenvolvimento de Sistemas no Senac.
Estou migrando para a área de TI com foco em desenvolvimento web e back-end, aprendendo tecnologias como PHP, JavaScript, MySQL e Python.
Tenho formação superior em Gestão Pública e estou em busca de oportunidades para aplicar e expandir meus conhecimentos.

---

📫 Contato:
- [LinkedIn](https://www.linkedin.com/in/wellington-xavier-90a004300/)
- [Portfólio](https://xavierdev.pages.dev)
