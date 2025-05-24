# Pré-requisitos
- Php ≥ 8.1
- Composer
- MySQL

# Instalação

1. Clone o projeto
2. Entre na pasta do projeto pelo terminal
3. Configure o arquivo .env com as suas credenciais - `cp .env.sample .env`
4. Instale as dependências `composer install`
5. Criar o banco de dados `CREATE DATABASE recipes;`
6. Executar as migrations `php yii migrate`
7. Iniciar o servidor `php yii serve --port=8080`
