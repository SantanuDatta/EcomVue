<div id="header" align="center">
    <img src="https://media.giphy.com/media/v1.Y2lkPTc5MGI3NjExcTl3dWs3eTE5bmpsaGx5a3ZtbGRwYXF6ZmJ4NzV5M2F1NnBobXZvZyZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/f3KwliaH4MLtli8z7D/giphy.gif" width="200" height="150">
    <div id="badges">
        <a href="https://www.linkedin.com/in/santanudatta94/">
            <img src="https://img.shields.io/badge/LinkedIn-blue?style=for-the-badge&logo=linkedin&logoColor=white" alt="LinkedIn Badge"/>
        </a>
        <a href="https://twitter.com/SantanuDatta94">
            <img src="https://img.shields.io/badge/Twitter-blue?style=for-the-badge&logo=twitter&logoColor=white" alt="Twitter Badge"/>
        </a>
    </div>
    <img src="https://komarev.com/ghpvc/?username=SantanuDatta&style=flat-square&color=blue" alt="Santanu Datta"/>
</div>

## EcomVue

This is a project made with Laravel and Vue using RestApi. With time features will be added.

## Getting Started

If you want to use my project first you can either download the zip file or you can clone it using the command to your designated location

```bash
git clone https://github.com/SantanuDatta/EcomVue.git
```

Setup your environment

```bash
cd EcomVue
cp .env.example .env
composer install
```

Make sure to generate a new key in the `env` and make necessary changes

```bash
php artisan key:generate
```

After creating the project, run migration & seeder

```bash
php artisan migrate
php artisan db:seed
```

or

```bash
php artisan migrate:fresh --seed
```

Now go to this directory

```bash
cd resources/js/client
```

And run

```bash
npm install
npm run dev
```

Note this is a work in progress features will added from time to time.

## Packages

These are packages that used for this project.

| **Package**                                                                                          | **Author**                                          |
| :-------------------------------------------------------------------------------------------------- | :-------------------------------------------------- |
| [Laravel Sluggable by Spatie](https://github.com/spatie/laravel-sluggable) | [Spatie](https://github.com/spatie) |

## License

EcomVue is provided under the [AGPL-3.0 license](LICENSE).
