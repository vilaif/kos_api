<?php

namespace App\Enums;

enum PermissionEnum: string
{
    // User Management
    case CREATE_USER = 'create_user';
    case EDIT_USER = 'edit_user';
    case DELETE_USER = 'delete_user';
    case VIEW_USER = 'view_user';

    // Room Management
    case CREATE_ROOM = 'create_room';
    case EDIT_ROOM = 'edit_room';
    case DELETE_ROOM = 'delete_room';
    case VIEW_ROOM = 'view_room';

    // Tenant Management
    case CREATE_TENANT = 'create_tenant';
    case EDIT_TENANT = 'edit_tenant';
    case DELETE_TENANT = 'delete_tenant';
    case VIEW_TENANT = 'view_tenant';

    // Invoice & Payment
    case CREATE_INVOICE = 'create_invoice';
    case EDIT_INVOICE = 'edit_invoice';
    case DELETE_INVOICE = 'delete_invoice';
    case VIEW_INVOICE = 'view_invoice';
    case CREATE_PAYMENT = 'create_payment';
    case EDIT_PAYMENT = 'edit_payment';
    case DELETE_PAYMENT = 'delete_payment';
    case VIEW_PAYMENT = 'view_payment';

    // Dashboard & Reports
    case VIEW_DASHBOARD = 'view_dashboard';
    case VIEW_REPORTS = 'view_reports';
    case EXPORT_REPORT = 'export_reports';
}