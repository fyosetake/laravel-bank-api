# laravel-bank-api

Este é um projeto em Laravel contendo APIs para manipulação de contas e transações financeiras, além de uma base de dados MySQL para persistir os dados.

## Pré-requisitos

- [Laravel](https://laravel.com/)
- [PHP](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Versões utilizadas

- PHP 8.2.10
- Laravel v10.24.0
- Composer version 2.5.8
- Docker version 24.0.6 (build ed223bc)

## Instalação

1. Clone o repositório:

```bash

git clone git@github.com:fyosetake/laravel-bank-api.git

```

2. Navegue até o diretório do projeto:

```bash

cd laravel-bank-api

```

3. Instale as dependências do Composer:

```bash

composer install

```

## Construa as imagens e inicie os Containeres no Docker

1. Construa as imagens da aplicação Laravel e do Banco de dados MySQL:

```bash

docker-compose build

```

2. Inicie os Containeres:

```bash

docker-compose up -dV

```

## Configurar o DB_HOST no Laravel

Para configurar o `DB_HOST` no arquivo `.env` do Laravel com o nome do container Docker MySQL, siga estas etapas:

1. Certifique-se de que o contêiner MySQL esteja em execução.

2. No terminal, execute o seguinte comando para obter o nome do contêiner MySQL:

```bash

docker ps

```

3. Na lista resultante, encontre o contêiner MySQL e copie o nome listado na coluna "NAMES".

4. Abra o arquivo `.env` no diretório do seu projeto Laravel.

5. Encontre a variável DB_HOST no arquivo `.env`.

6. Substitua o valor existente de `DB_HOST` pelo nome do contêiner Docker MySQL que você copiou na etapa 3.

7. Salve o arquivo `.env`.

Agora, o Laravel estará configurado para se conectar ao seu contêiner MySQL quando você executar a aplicação.

## Executar as migrações

1. Acesse o container do Laravel:

```bash

docker exec -it nome-do-container-laravel bash

```

2. No container, execute o comando Artisan para executar as migrações:

```bash

php artisan migrate

```

## Instruções para testes

Para rodar os testes de unidade, basta executar o seguinte comando:

```bash

php artisan test

```

## Instruções de uso

Conforme o desafio proposto, o uso pode ser assim definido:

1. Validar se uma conta existe (conta_id 1, por exemplo)

```bash

curl -i -X GET http://localhost:3000/api/conta/1

```

2. Criar uma conta

```bash

curl -i -X POST -H "Content-Type: application/json" -d '{"conta_id": "1", "valor": "500"}' http://localhost:3000/api/conta

```

3. Consultar o saldo dela

```bash

curl -i -X GET http://localhost:3000/api/conta/1

```

4. Efetue uma compra no valor de R$50 utilizando a opção de débito.

```bash

curl -i -X POST -H "Content-Type: application/json" -d '{"forma_pagamento":"D","conta_id": "1", "valor": "50"}' http://localhost:3000/api/transacao

```

5. Execute uma compra de R$100 usando a opção de crédito.

```bash

curl -i -X POST -H "Content-Type: application/json" -d '{"forma_pagamento":"C","conta_id": "1", "valor": "100"}' http://localhost:3000/api/transacao

```

6. Realize uma transferência via Pix no valor de R$75.

```bash

curl -i -X POST -H "Content-Type: application/json" -d '{"forma_pagamento":"P","conta_id": "1", "valor": "75"}' http://localhost:3000/api/transacao

```

7. Consulte o saldo final da conta (conta_id 1, neste exemplo)

```bash

curl -i -X GET http://localhost:3000/api/conta/1

```