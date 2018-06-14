<?php
namespace Tests;
class DemoTest extends \PHP_Unit_Framework_TestCase {
  public function testRenderReturnsHelloWorld(){
    $response = $this->get('/');
    $response->assertStatus(200);
  }
}
