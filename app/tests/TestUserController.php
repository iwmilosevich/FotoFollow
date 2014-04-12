<?php

class TestUserController extends TestCase {

  public function testHomeRoute(){
    $response = $this->action('GET', 'BaseController@showHome');

    $view = $response->original;
    $this->assertEquals('home', $view['name']);
  }

  public function testSignUp(){
    $response = $this->action('POST', 'UserController@doSignUp', $userdata = array(
        'name'    => 'Test McTesty',
        'email'   => 'test@gmail.com',
        'snapchatName' => 'tester',
        'username'  =>  'testies',
        'password'  => 'testtest',
        'phone' => '5555555555'
      ));

    $view = $response->original;
    DB::table('users')->where('username', '=', 'testies')->delete();
    $this->assertEquals('feed', $view['name']);

  }


}


?>