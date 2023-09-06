# Laravel Upgradator Package
<p align="center">
A Easy way to upgrade your laravel application when the application on production mode 
</p>


# Install

To get started with LaravelUpgradetor, use Composer to add the package to your project's dependencies:

```
composer require alimi7372/upgradetor
```
After that you should run laravel `migrate` command:
```
php artisan migrate
```

# Usage

You can now add new version to keep your main database records changes or run  commands or command after update your project:

```
php artisan version:make yourVersion
``` 

For example:

```
php artisan version:make 1.0.0
```

You can write your script to run after update in versioning file on `your-project-path/versions`.
Versioning File:

    namespace Alimi7372\Upgradetor\Versions;
	
    use Alimi7372\Upgradetor\Upgrade;
	
    return new class extends Upgrade
    {
        protected string $description = "description to explain your change";
        protected string $date = "2023-04-04 10:22";
        protected string $version = "1.0.0";
    
        public function up()
        {
            // TODO: Implement up() method.
        }
    
        public function down()
        {
            // TODO: Implement down() method.
        }
    };

You have tow methods in versioning files for upgrade and downgrade . You should write your script to run and upgrade in `up` method and wtire script to downgrade in `down` method.
You can  set description and comment on your version in variable `$description` on top of versioning file.

# Upgrade
For run upgrade scripts in versioning files you should run below command:

```
php artisan version:upgrade
```
You can run specific versioning upgrade script with add version at end:
```
php artisan version:upgrade 1.0.0
```
# Downgrade
For run downgrade scripts in versioning files you should run below command:

```
php artisan version:downgrade
```
You can run specific versioning downgrade script with add version at end:
```
php artisan version:downgrade 1.0.0
```


## ❤️ Open-Source Software - Give ⭐️

I have included the awesome `symfony/thanks` composer package as a dev
dependency.
Let your OS package maintainers know you appreciate them by starring
the packages you use.
Simply run `composer thanks` after installing this package.
(And not to worry, since it's a dev-dependency it won't be installed in your
live environment.)

## License

Laravel-Upgradator is open-sourced software licensed under the MIT License (MIT). Please see [License File](LICENSE.md) for more information.

<p align="center"> <b>Made with ❤️ <b> </p>
