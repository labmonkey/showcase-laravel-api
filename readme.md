![Screenshot](/screenshot.jpg?raw=true "Screenshot")

# CARS API

The purpose of this application was to create a simple project based on Laravel framework (PHP). This project is using all the basic and well known features of Laravel framework as well as MVC principles including:

- Developed using [Homestead](https://laravel.com/docs/5.4/homestead) in Vagrant
- Project structure was made using Laravel installer
- Blade template engine
- Eloquent ORM
- Additional libraries: 
  - [Eloquence](https://github.com/jarektkaczyk/eloquence) for full text search in DB
  - [Orchestral](https://github.com/orchestral/parser) for XML parsing
- All custom code contains comments
- Usage of Controllers
- Usage of Routes
- Usage of Middleware
- Usage of custom Artisan commands
- Repository Design Pattern ([\[1\]](https://bosnadev.com/2015/03/07/using-repository-pattern-in-laravel-5/), [\[2\]](http://shawnmc.cool/the-repository-pattern))

### Frontend

The theme is built using laravel-mix, SCSS and jQuery. It's using Twitter Bootstrap library. Blade templates are split into partial files.

### Use Case

- Application provides both public and restricted API endpoints that return JSON data from database

### Installation

- Recommended development environment is [Homestead](https://laravel.com/docs/5.4/homestead)
- `.env` file is required. You can copy `.env.example` (the one used by me)
- `touch database/database.sqlite` to create local DB
- `composer install` for required packages
- `npm install` for required dependencies
- `npm run dev` to compile assets
- `php artisan migrate` to create the database schema
- `php artisan vehicle:import` to import test data into DB

### Important custom files

- `app/Http/Controllers/SiteController.php` - Main Controller
- `app/Http/Controllers/ApiController.php` - REST API controller
- `app/Console/Commands/ImportVehicleXml.php` - imports Vehicle data from XML
- `app/Middleware/VerifyApiKey.php` - Used for API authentication. Checks if provided key exists.
- `app/Middleware/VerifyApiQuota.php` - Used for API quotas. Limits number of requests that can be performed.
- `app/Models/ApiKey.php`, `app/Models/ApiQuota.php`, `app/Models/Vehicle.php` - Models used in Eloquent
- `app/Components/JsonBuilder.php`, `app/Traits/JsonBuilderResponseTrait.php` - Used for clean building of JSON responses
- `app/Repositories` - Various Repositories that follow Repository Design Pattern
- `resources/views` - Blade templates
- `resources/assets` - JS and CSS
- `routes/web.php` - routes config
- `storage/app/local/VehicleSample.xml` - example file that is used to import data
- `database/migrations` - creates database tables
- `config/api.php` - contains custom config params