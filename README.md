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

3. Gere o arquivo '.env' à partir do '.env.example':

```bash

cp .env.example .env

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

## Execute as Migrations

Para executar as Migrations, acesse o container do Laravel:

1. Certifique-se de que o container esteja em execução.

```bash

docker ps

```

2. Os próximo comandos serão direcionados para o container, bastando executá-los no diretório do projeto.

3. Execute o 'composer install':

```bash

docker exec api-laravel composer install

```

4. Execute o comando para gerar uma 'chave de aplicativo' Laravel:

```bash

docker exec api-laravel php artisan key:generate

```

4. Execute o comando Artisan para rodar as Migrations:

```bash

docker exec api-laravel php artisan migrate

```

6. Rode os testes unitários:

```bash

docker exec api-laravel php artisan test

```

7. Inicie o servidor de desenvolvimento embutido no Laravel:

```bash

docker exec api-laravel php artisan serve --host=0.0.0.0 --port=80

```

## Instruções de uso

O uso pode ser assim definido:

1. Validar se uma conta existe (conta_i = 1, por exemplo)

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