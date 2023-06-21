<?php

namespace App\Services;

use Nette\Security\Permission;


class Authorizator
{
    /**
     * @return Permission
     */
    public static function create(): Permission
    {
        $acl = new Permission;

        // roles
        $acl->addRole('admin');
        $acl->addRole('librarius');
        $acl->addRole('user');

        // resources
        $acl->addResource('About');
        $acl->addResource('Article');
        $acl->addResource('BookOverview');
        $acl->addResource('Books');
        $acl->addResource('Users');


        // rules
        $acl->allow('admin', Permission::ALL, ['add', 'edit', 'delete','view']);
        $acl->allow('librarius', ['About', 'BookOverview', 'Books'], ['view', 'add', 'edit', 'delete']);
        $acl->allow('user', ['About','BookOverview'], ['view']);


        return $acl;
    }
}