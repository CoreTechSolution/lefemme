<?php

namespace Stripe;

class PermissionErrorTest extends TestCase
{
    /**
     * @expectedException Stripe\Error\Permission
     */
    public function testPermission()
    {
        $this->mockRequest('GET', '/v1/accounts/acct_DEF', array(), $this->permissionErrorResponse(), 403);
        Account::retrieve('acct_DEF');
    }

    private function permissionErrorResponse()
    {
        return array(
            'error' => array(),
        );
    }
}
