<?php

namespace App\Containers\User\UI\API\Tests\Functional;

use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class RefreshUserTest.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RefreshUserTest extends TestCase
{

    protected $endpoint = '/users/refresh';

    protected $access = [
        'roles'       => '',
        'permissions' => '',
    ];

    public function testRefreshUserById_()
    {
        // get the logged in user (create one if no one is logged in)
        $user = $this->createTestingUser();

        $data = [
            'user_id' => $user->id,
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());
    }

    public function testRefreshUserByToken_()
    {
        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', [], true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());
    }
}
