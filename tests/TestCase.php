<?php

Use App\User;

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */

    /**
    * @var \App\User
    */
    protected $defaultUser;
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }


    public function defaultUser(array $attributes=[])
    {//metodo que vamos a seguir usando para crear usuarios en las pruebas
        if($this->defaultUser){
            return $this->defaultUser; //si el usuario ya fue creado usar este, para no repetir la creacion.
        }
        return $this->defaultUser = factory(\App\User::class)->create();
    }

    protected function createPost(array $attributes = [])//metodo para crear post automaticos, solo pasando un titulo defino.
    {
        return factory(\App\Post::class)->create($attributes);
    }
}
