<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Sobre o Artisan CRM

O Artisan CRM(Customer Relationship Management) é um software open source desenvolvido utilizando o framework [Laravel](https://laravel.com/) e o template [AdminLTE](https://adminlte.io/) no padrão MVC.

- [Link Example](https://laravel.com/).
- [Link Example](https://laravel.com/).
- [Link Example](https://laravel.com/).
- [Link Example](https://laravel.com/).
- [Link Example](https://laravel.com/).

## Instalação
Você pode instalar este projeto via github ou fazendo download do repositório zipado.

1. Instalando via github:

```bash
https://github.com/lucas-eedu/artisan-crm.git
```

2. Crie um novo banco de dados no seu MySQL;

3. Dentro do diretório do projeto crie um arquivo chamado .env e cole as informações do arquivo .env-example

4. Configurando o arquivo .env com seus dados:
- Na linha 13 substitua o "seu_banco_de_dados" pelo nome do banco de dados que você criou no passo 2
- Na linha 14 substitua o "usuario_do_mysql" pelo nome do seu usuário MySQL
- Na linha 15 substitua o "senha_do_mysql" pela senha do seu usuário MySQL

4. Rode os comandos:

    Para instalar o composer e suas dependências no projeto
    ```bash
    composer install
    ```

    É usado para definir uma nova chave no seu arquivo .env(Essa chave é usada pelo serviço de criptografia do Laravel - Illuminate). 
    
    Referência: [Guilherme Nascimento](https://pt.stackoverflow.com/questions/434922/para-que-serve-o-comando-keygenerate-do-laravel)
    ```bash
    php artisan key:generate
    ```

    Para instalar o composer e suas dependências no projeto
    ```bash
    php artisan storage:link
    ```

    Para instalar o composer e suas dependências no projeto
    ```bash
    php artisan migrate
    ```

## Objetivo e Construção

Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis pariatur sunt amet voluptate aliquid! Et, cupiditate. Sint modi debitis minima, harum magni, error, aliquam sed possimus repellat voluptatibus hic maxime.

Lorem ipsum dolor sit, amet consectetur adipisicing elit. Debitis pariatur sunt amet voluptate aliquid! Et, cupiditate. Sint modi debitis minima, harum magni, error, aliquam sed possimus repellat voluptatibus hic maxime.

## Contribuidores

Obrigado por considerar contribuir com o Artisan CRM. Todo tipo de contribuição é bem-vindo, envie um PR!
