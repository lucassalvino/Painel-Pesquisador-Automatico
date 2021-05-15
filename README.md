# Execução

Passos:

0. criar o arquivo .env e configurar a conexão MSQL.
1. `composer install` || `composer install --ignore-platform-reqs`
2. `php artisan key:generate`
3. `composer dump-autoload`
4. `php artisan migrate`
5. `php artisan db:seed`
7. Acessar pasta Public (se for com servidor http) ou `php artisan serve`

# RESETAR BANCO DE DADOS

*** pq vc vai fazer isso? isso é realmente necessário? ***

0. faça o backup da base (pfv)
1. `php artisan migrate:reset`
2. `php artisan migrate`
3. `php artisan db:seed`
4. `php artisan db:gerapermissoes` (popular registros de permissoes)
5. feito



## middleware API 

* `cors`: Permitir que a API seja consumida por outros domínios. Adicionar em todos os endpoints
* `VerificaSessao`: Permite o usuário consumir o endpoint somente se o mesmo estiver logado. A sessão é passada no header, atributo: `Authorization`
* `PossuiPermissao`: Permite o usuário consumir o endpoint somente se o mesmo pertencer a um grupo que possua permissão para executar o verbo em questão da entidade da requisição em questão. Obs.: Deve ter prioridade menor que `VerificaSessao`, caso contrário será retornado erro 401.


## UTIL para GIT
* `git config core.fileMode false`: ignora alterações de permissões realizadas com o `chmod`
