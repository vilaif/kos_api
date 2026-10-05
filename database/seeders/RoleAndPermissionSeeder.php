<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // Create Permissions
        foreach (PermissionEnum::cases() as $permission) {
            Permission::findOrCreate($permission->value, 'web');
        }

        // Create Roles
        $ownerRole = Role::findOrCreate(RoleEnum::OWNER->value, 'web');
        $adminRole = Role::findOrCreate(RoleEnum::ADMIN->value, 'web');
        $tenantrRole = Role::findOrCreate(RoleEnum::TENANTS->value, 'web');

        // Assign permissions to roles
        $ownerRole->syncPermissions(PermissionEnum::cases());

        $adminRole->syncPermissions([
            PermissionEnum::VIEW_ROOM,
            PermissionEnum::CREATE_ROOM,
            PermissionEnum::EDIT_ROOM,
            PermissionEnum::VIEW_TENANT,
            PermissionEnum::CREATE_TENANT,
            PermissionEnum::EDIT_TENANT,
            PermissionEnum::VIEW_INVOICE,
            PermissionEnum::CREATE_INVOICE,
            PermissionEnum::CREATE_PAYMENT,
            PermissionEnum::VIEW_DASHBOARD,
            PermissionEnum::VIEW_REPORTS,
        ]);

        $tenantrRole->syncPermissions([
            PermissionEnum::VIEW_INVOICE,
            PermissionEnum::VIEW_REPORTS, // hanya lihat sendiri
        ]);
    }
}