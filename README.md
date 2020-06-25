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

```php
git clone https://github.com/rafaelbozzetti/feedz_challenger.git
cd feedz_challenger
composer install
```

### Configuração

Voce precisará criar uma database chamada feedz e importar o arquivo ``resources/database/feedz.sql``.

```php
$mysq -u root -p feedz < resources/database/feeds.sql
```

Depois deve-se configurar os parametros de conexao com o banco em ``app/config/settings.php``

```php
$settings['db'] = [
    'driver' => \Cake\Database\Driver\Mysql::class,
    'host' => 'localhost',
    'username' => 'root',
    'database' => 'feedz',
    'password' => 'sawa',
```

### Rodando o APP

```php
php -S localhost:8000 -t public/ 
```

### Acesso

 * usuario: admin@feedz.com.br
 * senha: sawa