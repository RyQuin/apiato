<?php

namespace App\Containers\Order\UI\API\Tests\Functional;

use App\Containers\Authorization\Models\Permission;
use App\Containers\Authorization\Models\Role;
use App\Containers\User\Models\User;
use App\Port\Test\PHPUnit\Abstracts\TestCase;

/**
 * Class AttachPermissionsToRoleTest.
 *
 * @author  Mahmoud Zalt <mahmoud@zalt.me>
 */
class AttachPermissionsToRoleTest extends TestCase
{

    protected $endpoint = '/permissions/attach';

    protected $access = [
        'roles'       => 'admin',
        'permissions' => '',
    ];

    public function testAttachSinglePermissionToRole_()
    {
        $this->getTestingAdmin();

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $permissionA = Permission::create([
            'name'         => 'permission-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $data = [
            'role_name' => $roleA['name'],
            'permission_name' => $permissionA['name'],
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

        $responseObject = $this->getResponseObject($response);

        $this->assertEquals($roleA['name'], $responseObject->data->name);
    }

    public function testAttachMultiplePermissionToRole_()
    {
        $this->getTestingAdmin();

        $roleA = Role::create([
            'name'         => 'role-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $permissionA = Permission::create([
            'name'         => 'permission-A',
            'description'  => 'AA',
            'display_name' => 'A',
        ]);

        $permissionB = Permission::create([
            'name'         => 'permission-B',
            'description'  => 'BB',
            'display_name' => 'B',
        ]);


        $data = [
            'role_name' => $roleA['name'],
            'permission_name' => [$permissionA['name'], $permissionB['name']]
        ];

        // send the HTTP request
        $response = $this->apiCall($this->endpoint, 'post', $data, true);

        // assert response status is correct
        $this->assertEquals('200', $response->getStatusCode());

    }


}
