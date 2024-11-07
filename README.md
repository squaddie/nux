## How-to

You need ports `80` and `5173` to be available, and docker to be installed and running on your machine, since we are going to use Laravel sail. 

- Clone a project and navigate there using CLI
- Execute `./vendor/bin/sail up -d`
- Execute `touch database/database.sqlite`
- Execute `./vendor/bin/sail artisan migrate`
- Execute `./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev`
- Open browser and navigate to `localhost/`
