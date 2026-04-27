<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create module for new feature structure';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $basePath = base_path('modules/' . $name);

        if (File::exists($basePath)) {
            $this->error("Module {$name} already exists.");
            return false;
        }

        $subFolders = ['Controllers', 'Actions', 'Services/Contracts', 'DTOs', 'Requests', 'Routes', 'Providers', 'Events'];
        foreach ($subFolders as $folder) {
            File::makeDirectory($basePath . '/' . $folder, 0755, true);
        }

        $this->createController($name, $basePath);
        $this->createServiceInterface($name, $basePath);
        $this->createService($name, $basePath);
        $this->createRequest($name, $basePath);
        $this->createActions($name, $basePath);
        $this->createServiceProvider($name, $basePath);
        $this->createRoute($name, $basePath);

        $this->info("Module {$name} created successfully!");
    }

    protected function createController($name, $modulePath)
    {
        $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class {$name}Controller extends Controller
{
    public function index()
    {
        // Code here
    }
}
PHP;
        File::put($modulePath . "/Controllers/{$name}Controller.php", $content);
    }

    protected function createServiceInterface($name, $modulePath)
    {
        $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Services\Contracts;

interface {$name}ServiceInterface
{
    //
}
PHP;
        File::put($modulePath . "/Services/Contracts/{$name}ServiceInterface.php", $content);
    }

    protected function createService($name, $modulePath)
    {
        $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Services;

use App\Modules\\{$name}\Services\Contracts\\{$name}ServiceInterface;

class {$name}Service implements {$name}ServiceInterface
{
    public function __construct()
    {
        //
    }
}
PHP;
        File::put($modulePath . "/Services/{$name}Service.php", $content);
    }

    protected function createServiceProvider($name, $modulePath)
    {
        $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\\{$name}\Services\\{$name}Service;
use App\Modules\\{$name}\Services\Contracts\\{$name}ServiceInterface;

class {$name}ServiceProvider extends ServiceProvider
{
    public function register()
    {
        \$this->app->bind({$name}ServiceInterface::class, {$name}Service::class);
    }

    public function boot()
    {
        \$this->loadRoutesFrom(__DIR__ . '/../Routes/api.php');
    }
}
PHP;
        File::put($modulePath . "/Providers/{$name}ServiceProvider.php", $content);
    }

    protected function createActions($name, $modulePath)
    {
        $methods = ['Store', 'Update', 'Destroy'];
        foreach ($methods as $method) {
            $fileName = "{$name}{$method}Action.php";
            $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Actions;

class {$name}{$method}Action
{
    public function execute(...\$args)
    {
        // Code here
    }
}
PHP;
            File::put($modulePath . "/Actions/{$fileName}", $content);
        }
    }

    protected function createRoute($name, $modulePath)
    {
        $lowerName = strtolower($name);
        $content = <<<PHP
<?php

use Illuminate\Support\Facades\Route;

Route::prefix('{$lowerName}')->group(function () {
    // 
});
PHP;
        File::put($modulePath . "/Routes/api.php", $content);
    }

    protected function createRequest($name, $modulePath)
    {
        $content = <<<PHP
<?php

namespace App\Modules\\{$name}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$name}Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
PHP;
        File::put($modulePath . "/Requests/{$name}Request.php", $content);
    }
}
