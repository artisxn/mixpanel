<?php namespace codicastudio\LaravelMixpanel\Tests;

use codicastudio\LaravelMixpanel\Providers\Service;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    public function createApplication()
    {
        $this->copyFixtures([
            __DIR__ . '/Fixtures/App/Http/Controllers/HomeController.php' => __DIR__ . '/../vendor/codicastudio/masterbase/app/Http/Controllers/HomeController.php',
            __DIR__ . '/Fixtures/resources/views/home.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/home.blade.php',
            __DIR__ . '/Fixtures/resources/views/auth/login.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/auth/login.blade.php',
            __DIR__ . '/Fixtures/resources/views/auth/register.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/auth/register.blade.php',
            __DIR__ . '/Fixtures/resources/views/auth/passwords/email.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/auth/passwords/email.blade.php',
            __DIR__ . '/Fixtures/resources/views/auth/passwords/reset.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/auth/passwords/email.blade.php',
            __DIR__ . '/Fixtures/resources/views/layouts/app.blade.php' => __DIR__ . '/../vendor/codicastudio/masterbase/resources/views/layouts/app.blade.php',
            __DIR__ . '/Fixtures/routes/web.php' => __DIR__ . '/../vendor/codicastudio/masterbase/routes/web.php',
        ]);
        $app = require __DIR__ . '/../vendor/codicastudio/masterbase/bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        $app->register(Service::class);

        return $app;
    }

    protected function copyFixtures(array $fixtures)
    {
        $fixtures = collect($fixtures)->each(function ($destination, $source) {
            $pathInfo = pathinfo($destination);

            if (! file_exists($pathInfo['dirname'])) {
                mkdir($pathInfo['dirname'], 0777, true);
            }

            copy($source, $destination);
        });
    }
}
