<?php

namespace App\Enums;

enum RoleEnum: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case TENANTS = 'tenant'; // untuk fase 2
}