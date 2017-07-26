<?php


class ExampleTest extends  FeatureTestCase
{
    
   
     function test_basic_example()
    {
        $user = factory(App\User::class)->create([
             'name' => 'Luis Carlos Marin Campos',
             'email'=> 'luiscarlosmarca@gmail.com',
        ]);

        $this->actingAs($user, 'api')
             ->visit('/api/user')
             ->see('Luis Carlos Marin Campos')
             ->see('luiscarlosmarca@gmail.com');
    }
}
