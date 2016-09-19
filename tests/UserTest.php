<?php

//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    //use DatabaseMigrations;

    public function getData($custom = array())
    {
        $data = [
            'name'      => 'joe',
            'email'     => 'joe@doe.com',
            'password'  => '12345'
            ];
        $data = array_merge($data, $custom);
        return $data;
    }

    public function testUserCreate()
    {
        $this->json('POST', '/user', ['name' => 'Sally', 'email' => 'Sally@gmail.com',
                                     'password' => 'Sally'])
             ->seeJson([
                 'created' => true,
             ]);

    }

    public function testValidationErrorOnCreateUser()
    {
        $data = $this->getData(['name' => '', 'email' => 'jane']);
        $this->post('/user', $data)->seeJson(['created' => false,]);
             
    }

    public function testNotFoundUser()
    {
        $this->get('/user/76')->seeJsonEquals(['error' => 'User not found']);
    }

    public function testUpdateUser()
    {
        $data = $this->getData(['name' => 'MODIFIED']);

        $this->put('/user/27', $data)
            ->seeJsonEquals(['updated' => true]);

        // Obtenemos los datos de dicho usuario modificado
        // y verificamos que el nombre sea el correcto
        $this->get('user/27')->seeJson(['name' => 'MODIFIED']);

        // Eliminamos al usuario
        $this->delete('user/27')->seeJson(['deleted' => true]);
    }
}