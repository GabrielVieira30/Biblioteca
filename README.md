# 📚 Sistema Biblioteca CRUD

Sistema completo de gerenciamento de biblioteca desenvolvido em PHP com MySQL, implementando operações CRUD para todas as entidades do sistema.

## 🏗️ Estrutura do Projeto

```
Biblioteca/
├── conexao.php          # Configuração da conexão com o banco
├── index.php            # Página inicial
├── css/
│   └── style.css        # Estilos CSS
├── models/              # Modelos de dados
│   ├── autor.php
│   ├── livro.php
│   ├── leitor.php
│   └── emprestimo.php
├── views/               # Visualizações
│   ├── livros.php
│   ├── autores.php
│   ├── leitores.php
│   └── emprestimos.php
├── excluir_livro.php    # Script de exclusão
├── database.sql         # Estrutura do banco
└── README.md           # Documentação
```

## 🗄️ Estrutura do Banco de Dados

### Tabelas Principais:

1. **autores**
   - `id_autor` (PK, AUTO_INCREMENT)
   - `nome` (VARCHAR, NOT NULL)
   - `nacionalidade` (VARCHAR)
   - `ano_nascimento` (INT)

2. **livros**
   - `id_livro` (PK, AUTO_INCREMENT)
   - `titulo` (VARCHAR, NOT NULL)
   - `genero` (VARCHAR)
   - `ano_publicacao` (INT, CHECK: 1500-ano atual)
   - `id_autor` (FK para autores)

3. **leitores**
   - `id_leitor` (PK, AUTO_INCREMENT)
   - `nome` (VARCHAR, NOT NULL)
   - `email` (VARCHAR, UNIQUE)
   - `telefone` (VARCHAR)

4. **emprestimos**
   - `id_emprestimo` (PK, AUTO_INCREMENT)
   - `id_livro` (FK para livros)
   - `id_leitor` (FK para leitores)
   - `data_emprestimo` (DATE, DEFAULT CURRENT_DATE)
   - `data_devolucao` (DATE, NULLABLE)

## 📋 Regras de Negócio

### Validações Implementadas:

1. **Livros**
   - Ano de publicação entre 1500 e ano atual
   - Cada livro pertence a um único autor

2. **Empréstimos**
   - Um livro só pode ser emprestado se não houver empréstimo ativo
   - Cada leitor pode ter no máximo 3 empréstimos ativos
   - Data de devolução não pode ser anterior à data de empréstimo

3. **Leitores**
   - Email único para cada leitor

## 🚀 Como Executar

### Pré-requisitos:
- XAMPP instalado
- PHP 7.4 ou superior
- MySQL 5.7 ou superior

### Passo a passo:

1. **Configurar o XAMPP**
   ```bash
   # Inicie o Apache e MySQL no XAMPP Control Panel
   ```

2. **Configurar o Banco de Dados**
   ```bash
   # Acesse o phpMyAdmin (http://localhost/phpmyadmin)
   # Crie um novo banco chamado 'biblioteca_crud'
   # Importe o arquivo database.sql
   ```

3. **Configurar a Conexão**
   ```php
   # Edite o arquivo conexao.php se necessário:
   $host = "localhost";
   $dbname = "biblioteca_crud";
   $user = "root";
   $pass = "";
   ```

4. **Acessar a Aplicação**
   ```
   http://localhost/caminho/para/Biblioteca/
   ```

## 🧪 Testes

### Testar CRUD de Livros:
1. Acesse "Gerenciar Livros"
2. Adicione um novo livro
3. Edite um livro existente
4. Exclua um livro
5. Teste validações (ano de publicação)

### Testar Empréstimos:
1. Acesse "Gerenciar Empréstimos"
2. Tente emprestar um livro já emprestado
3. Teste o limite de 3 empréstimos por leitor
4. Realize devoluções

### Testar Validações:
- Email duplicado em leitores
- Ano de publicação inválido
- Data de devolução anterior ao empréstimo

## 🎨 Funcionalidades

### ✅ Implementadas:
- [x] CRUD completo para todas as entidades
- [x] Validações de negócio
- [x] Interface responsiva
- [x] Filtros e relatórios
- [x] Sistema de empréstimos com controle de status
- [x] Design moderno e intuitivo

### 📊 Relatórios Disponíveis:
- Listagem de empréstimos ativos
- Listagem de empréstimos concluídos
- Livros emprestados por leitor
- Contagem de empréstimos ativos por leitor

## 🔧 Tecnologias Utilizadas

- **Backend:** PHP 7.4+
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Estilo:** CSS puro com design responsivo
- **Padrões:** MVC (Model-View-Controller)

## 📝 Notas de Desenvolvimento

### Estrutura MVC:
- **Models:** Classes PHP com lógica de negócio
- **Views:** Páginas HTML/PHP para interface
- **Controller:** Lógica de controle nas próprias views

### Segurança:
- Validação de entrada nos formulários
- Prevenção contra SQL Injection usando PDO prepared statements
- Validação de tipos de dados

### Performance:
- Consultas otimizadas com JOINs
- Paginação implementada
- Índices nas chaves estrangeiras

## 🤝 Contribuição

Para contribuir com o projeto:

1. Faça um fork do repositório
2. Crie uma branch para sua feature
3. Commit suas mudanças
4. Push para a branch
5. Abra um Pull Request

## 📞 Suporte

Em caso de dúvidas ou problemas:

1. Verifique se todas as dependências estão instaladas
2. Confirme que o banco de dados está configurado corretamente
3. Verifique as permissões de arquivo
4. Consulte o log de erros do Apache se necessário

## 📄 Licença

Este projeto é open source e está disponível sob a licença MIT.

---

**Desenvolvido como parte de atividade acadêmica - CRUD completo para biblioteca**
