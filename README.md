# API REST em PHP



## Requisitos

Softwares requeridos pelo projeto

- [PHP](https://www.php.net/)
- [XAMPP](https://www.apachefriends.org/pt_br/index.html) (possui suporte ao PHP)



## Configurando o ambiente

**Execute os comandos abaixo para rodar a aplicação**
```sh
# Realiza a instalação do gerenciador de dependências
$ composer update
```

Banco de Dados utilizado: **MySQL**

OBS: O arquivo ***database.sql*** encontra-se disponível na raiz do projeto para importação das tabelas.



## Endpoints

### Listar todos os usuários

**Request**

`GET /api/user`

**Response**

- `200 OK` ao ter sucesso

```json
{
    "status": 200,
    "message": "Successfully fetched.",
    "data": [
        {
            "id": "1",
            "name": "Jon Snow",
            "email": "jsnow@gmail.com",
            "password": "12345678"
        },
        {
            "id": "2",
            "name": "Daenerys Targaryen",
            "email": "daetarg@gmail.com",
            "password": "12345678"
        },
        {
            "id": "3",
            "name": "Cersei Lannister",
            "email": "cerseilan@gmail.com",
            "password": "12345678"
        }
    ]
}
```

- `404 Not Found` dados não encontrado

```json
{
    "status": 404,
    "message": "Data not found.",
    "data": []
}
```


### Retornar um usuário específico

`GET /api/user/<id>`

**Response**

- `200 OK` ao ter sucesso

```json
{
    "status": 200,
    "message": "Successfully fetched.",
    "data": [
        {
            "id": "4",
            "name": "Jon Snow",
            "email": "jsnow@gmail.com",
            "password": "12345678"
        }
    ]
}
```

- `404 Not Found` aluno não encontrado

```json
{
    "status": 404,
    "message": "Data not found.",
    "data": []
}
```


### Registrando um novo usuário

**Request**

`POST /api/user`

**Argumentos**

#### Content-Type: application/json

- `"name":string` -> do usuário
- `"email":string` -> email do usuário
- `"password":string` -> senha do usuário

```json
{
    "name": "Jon Snow",
    "email": "jsnow@gmail.com",
    "password": "12345678"
}
```

**Response**

- `201 Created` ao ter sucesso

```json
{
    "status": 201,
    "message": "Successfully registered.",
    "data": [
        {
            "id": "4",
            "name": "Jon Snow",
            "email": "jsnow@gmail.com",
            "password": "12345678"
        }
    ]
}
```

- `400 Bad Request` erro usuário já existe

```json
{
    "status": 400,
    "message": "User already exists.",
    "data": []
}
```

- `500 Internal error` erro com o servidor ou sistema

```json
{
    "status": 500,
    "message": "Unable to create.",
    "data": []
}
```


### Atualizando os dados do usuário

**Request**

`PUT /api/user/<id>`

**Argumentos**

#### Content-Type: application/json

- `"name":string` -> do usuário
- `"email":string` -> email do usuário
- `"password":string` -> senha do usuário

```json
{
    "name": "Jon Snow",
    "email": "jsnow@gmail.com",
    "password": "87654321"
}
```

**Response**

- `200 OK` ao ter sucesso

```json
{
    "status": 200,
    "message": "Successfully updated.",
    "data": [
        {
            "id": "4",
            "name": "Jon Snow",
            "email": "jsnow@gmail.com",
            "password": "87654321"
        }
    ]
}
```

- `404 Not Found` usuário não encontrado

```json
{
    "status": 404,
    "message": "User not found.",
    "data": []
}
```

- `500 Internal error` erro com servidor ou sistema

```json
{
    "status": 500,
    "message": "Unable to uptade.",
    "data": []
}
```


### Deletar um usuário

**Definição**

`DELETE /api/user/<id>`

**Response**

- `200 OK` ao ter sucesso

```json
{
    "status": 200,
    "message": "Successfully deleted.",
    "data": [
        {
            "id": "4",
            "name": "Jon Snow",
            "email": "jsnow@gmail.com",
            "password": "87654321"
        }
    ]
}
```

- `404 Not Found` usuário não encontrado

```json
{
    "status": 404,
    "message": "User not found.",
    "data": []
}
```

- `500 Internal error` erro com servidor ou sistema

```json
{
    "status": 500,
    "message": "Unable to delete.",
    "data": []
}
```
