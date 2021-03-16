<?php

namespace App\Tests;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use App\Entity\User;

class AuthenticationTest extends ApiTestCase
{
    public function testLogin(): void
    {
        $client = self::createClient();

        $user = new User();
        $user->setUsername('test');
        $user->setPassword(
            self::$container->get('security.password_encoder')->encodePassword($user, '$3CR3T')
        );

        $manager = self::$container->get('doctrine')->getManager();
        $manager->persist($user);
        $manager->flush();

        // test not authorized
        $client->request('GET', '/api/books');
        $this->assertResponseStatusCodeSame(401);

        // retrieve a token
        $response = $client->request('POST', '/authentication_token', [
            'headers' => ['Content-Type' => 'application/json'],
            'json' => [
                'username' => 'test',
                'password' => '$3CR3T',
            ],
        ]);

        $json = $response->toArray();
        $this->assertResponseIsSuccessful();
        $this->assertArrayHasKey('token', $json);

        // test authorized
        $client->request('GET', '/api/books');
        $this->assertResponseIsSuccessful();
    }
}
