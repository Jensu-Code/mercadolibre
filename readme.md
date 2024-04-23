# PLANTILLA DEMO 4

Manageable web system based on Symfony 7 and DPMarket theme.

## Installation

Use composer [composer](https://getcomposer.org/) to install pageadmin.

```bash
composer install
```

## Environment

create file .env.local in root project.
```bash
## GLOBAL ##
APP_ENV=dev
DATABASE_URL="mysql://root@127.0.0.1:3306/plantilla_demo4?serverVersion=8.2.0&charset=utf8mb4"
```

## Init Server

```bash
symfony server:start
```

## Webpack Encore Symfony
Use Encore [Docs](https://symfony.com/doc/current/frontend/encore/index.html) y 
UX Components [Docs](https://ux.symfony.com/) (Optional).

[Node](https://nodejs.org/) o [NVM](https://github.com/coreybutler/nvm-windows)
```bash
npm install
npm run watch
```
o [bun](https://bun.sh/) (Optional)
```bash
bun install
bun run watch
```

## Theme
Use theme admin [DPMarket](https://wowtheme7.com/tf/dpmarket/index.html).


# Tools
## Php-cs-fixer
Optimice and formatting code
```bash
.\vendor\bin\php-cs-fixer fix src/
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
v1.0.0 [PIDIA SRL](http://www.pidia.pe/)