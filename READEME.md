# アプリケーション名
contact-form

## 環境構築

### Dockerビルド

- git clone git@github.com:kooooooota/test_contact-form.git
- docker-compose up -d --build

## Laravel環境構築

- docker-compose exec php bash
- composer install
- cp .env.example .env,環境変数を適宜変更
- php artisan key:generate
- php artisan migrate
- php artisan db:seed

## 開発環境

- お問い合わせ画面：http://localhost/
- ユーザー登録：http://localhost/register
- phpMyAdmin：http://localhost:8080/

## 使用技術（実行環境）

- PHP 8.1.34
- Laravel 8.83.29
- MySQL 8.0.26
- nginx 1.21.1

## ER図
## データベース設計 (ER図)

```mermaid
erDiagram
    categories ||--|| contacts : "relation"
    categories {
        bigint_unsigned id
        varchar(255) content
        timestamp created_at
        timestamp updated_at
    }
    contacts { 
        bigint_unsigned id
        bigint_unsigned category_id
        varchar(255) first_name
        varchar(255) last_name
        tinyint gender
        varchar(255) email
        varchar(255) tel
        varchar(255) address
        varchar(255) building
        text detail
        timestamp created_at
        timestamp updated_at
    }
    users {
        bigint_unsigned id
        varchar(255) name
        varchar(255) email
        varchar(255) password
        timestamp created_at
        timestamp updated_at
    }






