
# Gestão Comunitária 🚀

Este projeto foi desenvolvido como parte integrante da disciplina de **Práticas Extensionistas III**. Trata-se de um sistema web completo voltado para o controle de doações, gerenciamento de ações comunitárias e engajamento de voluntários.

---

## 📁 Estrutura do Repositório

O repositório foi populado com a estrutura inicial de arquivos estruturados da seguinte forma:

* `index.php` — Painel principal e dashboard do sistema.
* `auth.php`, `login.html`, `logout.php` — Módulo completo de controle de acesso e sessões.
* `db_connect.php` — Configuração de conexão com o banco de dados MySQL.
* `fale_conosco.php` — Canal de atendimento integrado com envio de e-mails via Formspree.
* `style.css` e `script.js` — Identidade visual e interatividade do sistema.
* `📂 crud/` — Operações de manipulação do banco (Listar, Inserir, Editar, Atualizar e Excluir doações).
* `📂 sql/` — Contém o arquivo `banco.sql` com as queries de criação de tabelas.
* `📂 diagramas/` — Pasta contendo toda a documentação visual da engenharia do software.

---

## 📊 Documentação e Engenharia de Software

O projeto conta com toda a modelagem de processos e dados documentada em formato visual dentro da pasta `/diagramas`:

1.  **Diagrama de Atividades:** Mapeamento do fluxo de processos em `atividade_atendimento.png` e `atividade_cadastro_acao.png`.
2.  **Diagrama de Casos de Uso (`caso_uso.png`):** Identificação dos atores e suas respectivas permissões e interações com o sistema.
3.  **Diagrama de Classes (`diagrama_classes.png`):** Representação da estrutura lógica e regras de negócio mapeadas.
4.  **Modelagem de Banco de Dados:** Estruturação através do Modelo Entidade-Relacionamento (`mer_conceitual.png` e `mer_logico.png`).
5.  **Diagrama de Sequência (`sequencia.png`):** Linha do tempo das operações e requisições do sistema.

---

## 🛠️ Tecnologias Utilizadas

* **Linguagem Principal:** PHP (Backend estruturado)
* **Banco de Dados:** MySQL / MariaDB (Executado via ambiente local XAMPP)
* **Frontend:** HTML5, CSS3 e JavaScript nativo
* **Integração:** API Formspree para tratamento de formulários de contato

---

## ⚙️ Como Executar Localmente

1. Certifique-se de ter o **XAMPP** (ou servidor similar com PHP e MySQL) instalado.
2. Clone este repositório ou mova a pasta para dentro do diretório do seu servidor local (ex: `C:\xampp\htdocs\gestao_comunitaria`).
3. Importe o arquivo `sql/banco.sql` no seu gerenciador de banco de dados (phpMyAdmin).
4. Certifique-se de que as credenciais no arquivo `db_connect.php` estão de acordo com o seu ambiente.
5. Inicie os módulos Apache e MySQL no painel do XAMPP.
6. Acesse no navegador: `http://localhost/gestao_comunitaria/`

## 💾 Download do Projeto

Se você deseja baixar todos os arquivos e diagramas do projeto de uma vez em um arquivo compactado `.zip`, clique no link abaixo:

👉 [Baixar Projeto Completo (.zip)](https://github.com/Rafael0906/praticas-extencionistas-iii/archive/refs/heads/main.zip)
