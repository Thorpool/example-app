## Configuration
### Prérequis

Mettre en place une base pas défaut avec le nom 'laravel' si vous souhaiter un autre nom penser a changer le .env

### Commandes à effectuer pour lancer le programme

- composer install
- php artisan migrate
- php artisan db:seed
- php artisan jwt:secret
- php artisan serve

La commande db:seed va mettre en place la base avec toutes les infos du json mock_data et créer un user avec comme info de connection :

'email' => 'test@test.com'

'password' => 'password'

Ces infos seront utiles pour se connecter au front
