# 📝 Sistema de Gerenciamento de Tarefas (To-Do List)

Este repositório contém uma aplicação web completa para gerenciamento de listas de tarefas, desenvolvida em PHP com integração de banco de dados MySQL. O sistema foi projetado para oferecer uma experiência de usuário intuitiva e segura, permitindo o controle individual de atividades.

## 📋 Descrição do Projeto
O Sistema de Tarefas (To-Do List) utiliza PHP e MySQL para o gerenciamento de dados. A aplicação conta com autenticação de usuários via login e senha protegida por MD5, além de controle rigoroso de sessões para proteção de rotas internas. Possui um CRUD completo que permite criar, listar, editar, concluir e excluir tarefas de forma dinâmica. A interface é responsiva e utiliza o framework Tailwind CSS, apresentando componentes modernos como cards de tarefas e badges de status coloridos. Todo o backend foi implementado utilizando PDO e Prepared Statements para garantir a integridade dos dados e segurança contra SQL Injection.

## 🚀 Tecnologias e Frameworks
* **Linguagem:** PHP 8.x
* **Banco de Dados:** MySQL (utilizando PDO)
* **Frontend:** Tailwind CSS (via CDN)
* **Segurança:** Criptografia de senhas em MD5 e consultas preparadas (Prepared Statements).

## 📂 Estrutura de Arquivos
1.  `conexao.php`: Configuração da conexão com o banco de dados.
2.  `login.php`: Interface e lógica de autenticação de usuários.
3.  `logout.php`: Encerramento de sessão e redirecionamento de segurança.
4.  `index.php`: Dashboard principal com listagem de tarefas e controle de acesso.
5.  `nova.php`: Formulário para cadastro de novas atividades.
6.  `editar.php`: Interface para modificação de tarefas e alteração de status.
7.  `concluir.php`: Script para atualização rápida do status da tarefa.
8.  `excluir.php`: Lógica para remoção de registros do sistema.
9.  `layout.php`: Arquivo centralizador de componentes visuais (Header e Navbar).

## ⚙️ Instruções de Configuração
1.  Clone este repositório para o diretório `htdocs` do seu servidor local (XAMPP/WAMP).
2.  Crie um banco de dados MySQL chamado `tarefas`.
3.  Importe a estrutura das tabelas abaixo:

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

-- Usuário padrão para testes:
-- Login: admin | Senha: 123456
INSERT INTO usuarios (usuario, senha) VALUES ('admin', '123456');
