# Clube Envio API

## Descrição

A API do Clube Envio oferece funcionalidades para o gerenciamento de cotações de frete. Através dela, os usuários podem registrar-se, fazer login e obter cotações de frete baseadas em suas informações.

## Rotas da API

### Registro e Autenticação

- **Registrar um novo usuário**
  - `POST /register`
  - Corpo da requisição:
    ```json
    {
      "name": "Nome do Usuário",
      "email": "usuario@example.com",
      "password": "senha"
    }
    ```

- **Login do usuário**
  - `POST /login`
  - Corpo da requisição:
    ```json
    {
      "email": "usuario@example.com",
      "password": "senha"
    }
    ```

### Rotas Protegidas (Autenticação Necessária)

Essas rotas estão agrupadas pelo middleware `sanctum`, então será necessária autenticação para acessá-las.

- **Obter informações do usuário autenticado**
  - `GET /user`

- **Cotação de frete**
  - `GET /frete/cotacao`
  - Parâmetros: 
    - Peso do pacote e CEP de destino devem ser passados na requisição.

- **Obter cotação específica**
  - `GET /frete/cotacao/{quoteId}`
  - Parâmetros:
    - `quoteId`: ID da cotação desejada.

- **Obter cotações de um usuário**
  - `GET /frete/usuario/{userId}/cotacoes`
  - Parâmetros:
    - `userId`: ID do usuário cujas cotações devem ser recuperadas.

## Autenticação

Para autenticar a API, utilize o Laravel Sanctum. Certifique-se de incluir o token de autenticação nas requisições para as rotas protegidas.

## Tecnologias Utilizadas

- Laravel 11
- Laravel Sanctum para autenticação
- Eloquent ORM para gerenciamento de banco de dados

## Como Executar

1. Clone o repositório:
   ```bash
   git clone https://github.com/angelof4/api-clube-envio.git
2. Banco de dados refatorado:
    este projeto tem dependencia de um banco de dados refatorado, disponibilizado pelo link: 
    ```bash
    git clone https://github.com/angelof4/clube-de-envios-db-refactor.git
3. apos realizar donwload do banco importa-lo
4. Configurar o .ENV informando o nome do banco de dados
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=clube_envios
    DB_USERNAME=root
    DB_PASSWORD=0000 //importante por a senha do seu mysql
4. rodar os comandos:
    ```bash
    composer install
    php artisan serve
## usando postman para testar rotas

# Rotas da API - Clube Envio

## Registro de Usuário

- **Endpoint**: `POST 127.0.0.1:8000/api/register`
- **Descrição**: Registra um novo usuário.
- **Body da Requisição**:
    ```json
    {
      "email": "usuario@example.com",
      "password": "senha",
      "nome": "Nome do Usuário"
    }
    ```

---

## Login de Usuário

- **Endpoint**: `POST 127.0.0.1:8000/api/login`
- **Descrição**: Realiza a autenticação e obtém um token de acesso.
- **Body da Requisição**:
    ```json
    {
      "email": "usuario@example.com",
      "password": "senha"
    }
    ```

---

## Cotação de Frete

- **Endpoint**: `GET 127.0.0.1:8000/api/frete/cotacao?peso=250&cep_inicio=72800001&cep_destino=72800999`
- **Descrição**: Obtém a cotação de fretes de acordo com os dados fornecidos: peso, CEP de início e CEP de destino.
- **Parâmetros**:
    - `peso`: Peso do pacote em gramas.
    - `cep_inicio`: CEP de origem.
    - `cep_destino`: CEP de destino.
- **Requisitos**: Necessária autenticação para executar esta rota.

---

## Cotações de um Usuário

- **Endpoint**: `GET 127.0.0.1:8000/api/frete/usuario/{userId}/cotacoes`
- **Descrição**: Obtém as cotações associadas a um usuário específico.
- **Parâmetros**:
    - `userId`: ID do usuário cujas cotações devem ser recuperadas.
- **Requisitos**: Necessária autenticação e informar o ID do usuário.

---

## Obter Cotação Específica

- **Endpoint**: `GET 127.0.0.1:8000/api/frete/cotacao/{quoteId}`
- **Descrição**: Obtém os dados de uma cotação específica pelo ID da cotação.
- **Parâmetros**:
    - `quoteId`: ID da cotação desejada.
- **Requisitos**: Necessária autenticação.

---

### Observações
- Todas as requisições que requerem autenticação devem incluir o token de acesso obtido no login.

