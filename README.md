# feedz_challenger


### Especificação

* Cadastrar um usuário
* Acessar o sistema usando um usuário já cadastrado (sistema de login)
* Visualizar todos os usuários já cadastrados.


### Requisitos

* PHP 7.2+
* MySQL 5.7+ or MariaDB
* Composer (only for development)



### Configuração

Clone o repositório e instale as dependências:

```console
git clone https://github.com/rafaelbozzetti/feedz_challenger.git
cd feedz_challenger
composer install
composer update
```

### Configuração Manual

Crie uma database chamada ```feedz``` e importar o arquivo ``resources/database/feedz.sql``.

```console
mysql -u root -p feedz < resources/database/feedz.sql
```

Depois deve-se configurar os usuario e senha do seu banco ``app/config/settings.php`` nas linhas 55 e 57.

```php
$settings['db'] = [
    'driver' => \Cake\Database\Driver\Mysql::class,
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'feedz',
    'password' => 'xxx',
```

Para rodar a aplicação:

```console
php -S localhost:8000 -t public/ 
```

### Configuração via docker

O projeto pode rodar via docker, não sendo necessário os passos anteriores.

```console
docker-composer up
```

Aguarde os containers subirem completamente.

### Acesso
 * acesso: http://localhost:8000/
 * usuario: admin@feedz.com.br
 * senha: sawa
