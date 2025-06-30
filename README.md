<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


# Instalação e Configuração do Banco de Dados

```bash
# 1. Execute para instalar o vendor
composer install

# 2. Criar o banco de dados e executar as migrações
php artisan migrate

# 3. Popular o banco de dados com dados iniciais (seed)
php artisan db:seed

# Opção combinada (migrate + seed)
php artisan migrate --seed

```

## Sobre o Sistema de Seed

O seed (semeamento) é um mecanismo do Laravel que:

1. Popula o banco de dados com dados iniciais para desenvolvimento e teste

2. Cria registros essenciais como usuários administrativos, categorias básicas e configurações iniciais

3. Garante consistência ao fornecer um conjunto padrão de dados para todos os ambientes

No nosso sistema, o seed inclui:

- Um usuário administrador master (credenciais abaixo)

- Estrutura básica de categorias

- Marcas iniciais para demonstração

- Dados de exemplo para testes


# Credenciais de Acesso Administrativo

- O sistema aceita tanto o nome de usuário quanto o e-mail para login

- Esta conta possui privilégios de administrador master (is_master = true)

```bash
Usuário: helder
E-mail: helder@gmail.com
Senha: 12345678
```