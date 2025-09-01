# 🌐 Rede Social em PHP MVC

Este projeto é uma aplicação de rede social completa, desenvolvida do zero utilizando **PHP Orientado a Objetos** e o padrão de arquitetura **Model-View-Controller (MVC)**. O objetivo foi criar uma plataforma funcional, segura e bem estruturada, aplicando os principais conceitos do desenvolvimento web back-end.

---

### **🎬 Demonstração**

![redesocial](https://github.com/YanzinhoCaue/PROJETO-REDE-SOCIAL/assets/127339610/e820164f-a520-4213-8292-401caea04f6d)

---

### **✅ Funcionalidades Principais**

* **👤 Sistema de Usuários**:
    * Cadastro de novas contas com validação de dados.
    * Login seguro com gerenciamento de sessão (`$_SESSION`).
    * Logout e encerramento da sessão.

* **✏️ Edição de Perfil**:
    * Atualização de informações pessoais (nome, senha).
    * Funcionalidade de **upload de imagem** para a foto de perfil, com validações de tipo e tamanho de arquivo.

* **📰 Feed de Notícias**:
    * Visualização de posts do próprio usuário e de seus amigos, ordenados cronologicamente.
    * Formulário para criação de novas publicações.

* **🤝 Sistema de Amizades**:
    * Página "Comunidade" para listar outros usuários.
    * Envio, aceitação e recusa de pedidos de amizade.

---

### **🏛️ Arquitetura e Boas Práticas**

A aplicação foi desenvolvida com foco em organização e segurança:

**Padrão de Arquitetura MVC**
* **Models**: Responsáveis pela lógica de negócio e interação com o banco de dados.
* **Views**: Camada de apresentação, contendo o HTML e a renderização dos dados.
* **Controllers**: Orquestram o fluxo da aplicação, recebendo as requisições e conectando os Models com as Views.

**PHP Orientado a Objetos (OOP)**
* Todo o código foi estruturado em classes (`Controllers`, `Models`, `Application`, etc.), promovendo a reutilização e a organização do código.

**Segurança**
* **Senhas Criptografadas**: As senhas dos usuários são armazenadas de forma segura no banco de dados utilizando as funções nativas do PHP `password_hash()` e `password_verify()`.
* **Prevenção de SQL Injection**: Todas as consultas ao banco de dados são feitas com **Prepared Statements** através da extensão **PDO**, prevenindo ataques de injeção de SQL.

**Banco de Dados com PDO**
* A conexão com o banco de dados MySQL é feita através de uma classe wrapper que utiliza PDO, o método mais moderno e seguro para interagir com bancos de dados em PHP.

---

### **🛠️ Tecnologias Utilizadas**

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

---

### **▶️ Como Executar o Projeto**

**Pré-requisitos:** Um ambiente de servidor local como XAMPP, WAMP ou MAMP (que inclua Apache, MySQL e PHP) e o Composer.

**1️⃣ Clone o repositório**
Clone o projeto para dentro da pasta raiz do seu servidor local (ex: `htdocs` no XAMPP).
```bash
git clone [https://github.com/YanzinhoCaue/projeto-rede-social.git](https://github.com/YanzinhoCaue/projeto-rede-social.git)
````

**2️⃣ Crie o Banco de Dados**

  * Crie um novo banco de dados no seu MySQL (ex: `rede_social`).
  * Importe o arquivo `.sql` do projeto para criar as tabelas necessárias. (Caso não haja um, você precisará criá-las manualmente com base no código dos Models).

**3️⃣ Configure a Conexão**

  * Abra o arquivo `REDE-SOCIAL/MySql.php`.
  * Altere as credenciais de conexão (`host`, `dbname`, `root`, `password`) para as do seu ambiente local.

**4️⃣ Instale as dependências (Autoload)**

```bash
cd projeto-rede-social
composer install
```

**5️⃣ Acesse a Aplicação**
Abra seu navegador e acesse `http://localhost/projeto-rede-social` (ou o nome da pasta que você utilizou).

-----

### **💬 Contato**

**Yan Cauê**

**LinkedIn:** [linkedin.com/in/yancue](https://linkedin.com/in/yancaue)

**GitHub:** [github.com/YanzinhoCaue](https://github.com/YanzinhoCaue)
