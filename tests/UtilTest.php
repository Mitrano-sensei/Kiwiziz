<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UtilTest extends WebTestCase
{
    public function testRegister(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');

        $form = $crawler->selectButton('Register')->form();

        $form['registration_form[username]'] = 'lina';
        $form['registration_form[plainPassword]'] = '123456';

        $crawler = $client->submit($form);
        
        // Assert that the response is not a redirect
        $this->assertFalse($client->getResponse()->isRedirect());

        // Assert that the response status code is 200
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testRegisterFailed(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Register');

        $form = $crawler->selectButton('Register')->form();

        $form['registration_form[username]'] = 'lina';
        $form['registration_form[plainPassword]'] = '12';

        $crawler = $client->submit($form);
        
        //register failed
        $client->followRedirects();
        $this->assertFalse($client->getResponse()->isRedirect());

        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertStringContainsString('Your password should be at least 6 characters', $content);

    }

    public function testLoginFailed(): void 
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');

        $form = $crawler->selectButton('Login')->form();

        $form['username'] = 'lina';
        $form['password'] = '123';

        $crawler = $client->submit($form);

        //fail to login
        $client->followRedirects();
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertResponseRedirects('/login');

        $response = $client->getResponse();
        $content = $response->getContent();
        $this->assertSelectorTextContains('title', 'Redirecting to /login');

    }

    public function testLogin(): void 
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Please sign in');

        $form = $crawler->selectButton('Login')->form();

        $form['username'] = 'lina';
        $form['password'] = '123456';

        $crawler = $client->submit($form);

        //success to login
        $client->followRedirects();
        $this->assertTrue($client->getResponse()->isRedirect());
        $this->assertResponseRedirects('/');
    }

    public function testCreateQuizz(): void
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['username'] = 'lina';
        $form['password'] = '123456';
        $client->submit($form);

        $client->followRedirects();
        $this->assertSelectorTextContains('title', 'Redirecting to /');
                
        $crawler = $client->request('GET', '/create/quiz');
        
        $form = $crawler->selectButton('Create')->form();
        $form['quizz_form[title]'] = 'test';
        
        $client->submit($form);
        $client->followRedirects();
        $response = $client->getResponse();
        $content = $response->getContent();

        $this->assertSelectorTextContains('title', 'Hello HomeController!');
          
    }

}
