# 📝 Sistema de Gerenciamento de Tarefas (To-Do List)

Este projeto é uma aplicação web completa de lista de tarefas, desenvolvida como parte da **Questão A da Prova de Desenvolvimento de Sistemas**. O sistema permite que usuários autenticados gerenciem suas atividades diárias através de uma interface moderna e funcional.

## 📋 Descrição do Projeto (300+ caracteres)
Sistema de Tarefas (To-Do List) desenvolvido em PHP e MySQL. O projeto conta com autenticação de usuários via login e senha protegida por MD5, além de gerenciamento de sessões para segurança das rotas. Possui um CRUD completo que permite criar, listar, editar, concluir e excluir tarefas de forma dinâmica. A interface é moderna, responsiva e utiliza o framework Tailwind CSS com componentes como cards e badges de status coloridos. Implementado com PDO e Prepared Statements para garantir a segurança dos dados e evitar ataques de SQL Injection. Login de teste disponível: admin | Senha: 123456.

## 🚀 Tecnologias e Frameworks
* **Linguagem:** PHP 8.x
* **Banco de Dados:** MySQL (PDO)
* **Framework de Layout:** Tailwind CSS (via CDN)
* **Segurança:** Criptografia MD5 para senhas e Prepared Statements.

## 📂 Estrutura de Arquivos Exigida
1.  `conexao.php`: Gerencia a conexão PDO com o banco de dados.
2.  `login.php`: Formulário de autenticação estilizado.
3.  `logout.php`: Destruição de sessão e redirecionamento seguro.
4.  `index.php`: Painel principal com listagem de tarefas e badges coloridos (Verde/Amarelo).
5.  `nova.php`: Interface para adição de novas tarefas.
6.  `editar.php`: Edição de registros com campos pré-preenchidos.
7.  `concluir.php`: Processamento lógico para atualizar status para "concluída".
8.  `excluir.php`: Remoção física de registros do banco de dados.
9.  `layout.php`: Componentes globais de interface (Header/Navbar).

## ⚙️ Instruções de Instalação
1.  Clone este repositório para o diretório `htdocs` do seu XAMPP.
2.  Crie o banco de dados chamado `tarefas`.
3.  Execute o seguinte SQL para criar as tabelas:

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT,
    status ENUM('pendente', 'concluida') DEFAULT 'pendente',
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);

-- Usuário padrão: admin / senha: 123456
INSERT INTO usuarios (usuario, senha) VALUES ('admin', 'e10adc3949ba59abbe56e057f20f883e');
