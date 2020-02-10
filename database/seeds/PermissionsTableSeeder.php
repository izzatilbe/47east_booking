<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'venue_management_access',
            ],
            [
                'id'    => '18',
                'title' => 'venue_create',
            ],
            [
                'id'    => '19',
                'title' => 'venue_edit',
            ],
            [
                'id'    => '20',
                'title' => 'venue_show',
            ],
            [
                'id'    => '21',
                'title' => 'venue_delete',
            ],
            [
                'id'    => '22',
                'title' => 'venue_access',
            ],
            [
                'id'    => '23',
                'title' => 'accommodation_create',
            ],
            [
                'id'    => '24',
                'title' => 'accommodation_edit',
            ],
            [
                'id'    => '25',
                'title' => 'accommodation_show',
            ],
            [
                'id'    => '26',
                'title' => 'accommodation_delete',
            ],
            [
                'id'    => '27',
                'title' => 'accommodation_access',
            ],
            [
                'id'    => '28',
                'title' => 'accom_category_create',
            ],
            [
                'id'    => '29',
                'title' => 'accom_category_edit',
            ],
            [
                'id'    => '30',
                'title' => 'accom_category_show',
            ],
            [
                'id'    => '31',
                'title' => 'accom_category_delete',
            ],
            [
                'id'    => '32',
                'title' => 'accom_category_access',
            ],
            [
                'id'    => '33',
                'title' => 'accommodation_management_access',
            ],
            [
                'id'    => '34',
                'title' => 'venue_category_create',
            ],
            [
                'id'    => '35',
                'title' => 'venue_category_edit',
            ],
            [
                'id'    => '36',
                'title' => 'venue_category_show',
            ],
            [
                'id'    => '37',
                'title' => 'venue_category_delete',
            ],
            [
                'id'    => '38',
                'title' => 'venue_category_access',
            ],
            [
                'id'    => '39',
                'title' => 'venue_tag_create',
            ],
            [
                'id'    => '40',
                'title' => 'venue_tag_edit',
            ],
            [
                'id'    => '41',
                'title' => 'venue_tag_show',
            ],
            [
                'id'    => '42',
                'title' => 'venue_tag_delete',
            ],
            [
                'id'    => '43',
                'title' => 'venue_tag_access',
            ],
            [
                'id'    => '44',
                'title' => 'accom_tag_create',
            ],
            [
                'id'    => '45',
                'title' => 'accom_tag_edit',
            ],
            [
                'id'    => '46',
                'title' => 'accom_tag_show',
            ],
            [
                'id'    => '47',
                'title' => 'accom_tag_delete',
            ],
            [
                'id'    => '48',
                'title' => 'accom_tag_access',
            ],
            [
                'id'    => '49',
                'title' => 'accom_amenity_create',
            ],
            [
                'id'    => '50',
                'title' => 'accom_amenity_edit',
            ],
            [
                'id'    => '51',
                'title' => 'accom_amenity_show',
            ],
            [
                'id'    => '52',
                'title' => 'accom_amenity_delete',
            ],
            [
                'id'    => '53',
                'title' => 'accom_amenity_access',
            ],
            [
                'id'    => '54',
                'title' => 'venue_amenity_create',
            ],
            [
                'id'    => '55',
                'title' => 'venue_amenity_edit',
            ],
            [
                'id'    => '56',
                'title' => 'venue_amenity_show',
            ],
            [
                'id'    => '57',
                'title' => 'venue_amenity_delete',
            ],
            [
                'id'    => '58',
                'title' => 'venue_amenity_access',
            ],
            [
                'id'    => '59',
                'title' => 'customer_create',
            ],
            [
                'id'    => '60',
                'title' => 'customer_edit',
            ],
            [
                'id'    => '61',
                'title' => 'customer_show',
            ],
            [
                'id'    => '62',
                'title' => 'customer_delete',
            ],
            [
                'id'    => '63',
                'title' => 'customer_access',
            ],
            [
                'id'    => '64',
                'title' => 'audit_log_show',
            ],
            [
                'id'    => '65',
                'title' => 'audit_log_access',
            ],
            [
                'id'    => '66',
                'title' => 'expense_management_access',
            ],
            [
                'id'    => '67',
                'title' => 'expense_category_create',
            ],
            [
                'id'    => '68',
                'title' => 'expense_category_edit',
            ],
            [
                'id'    => '69',
                'title' => 'expense_category_show',
            ],
            [
                'id'    => '70',
                'title' => 'expense_category_delete',
            ],
            [
                'id'    => '71',
                'title' => 'expense_category_access',
            ],
            [
                'id'    => '72',
                'title' => 'income_category_create',
            ],
            [
                'id'    => '73',
                'title' => 'income_category_edit',
            ],
            [
                'id'    => '74',
                'title' => 'income_category_show',
            ],
            [
                'id'    => '75',
                'title' => 'income_category_delete',
            ],
            [
                'id'    => '76',
                'title' => 'income_category_access',
            ],
            [
                'id'    => '77',
                'title' => 'expense_create',
            ],
            [
                'id'    => '78',
                'title' => 'expense_edit',
            ],
            [
                'id'    => '79',
                'title' => 'expense_show',
            ],
            [
                'id'    => '80',
                'title' => 'expense_delete',
            ],
            [
                'id'    => '81',
                'title' => 'expense_access',
            ],
            [
                'id'    => '82',
                'title' => 'income_create',
            ],
            [
                'id'    => '83',
                'title' => 'income_edit',
            ],
            [
                'id'    => '84',
                'title' => 'income_show',
            ],
            [
                'id'    => '85',
                'title' => 'income_delete',
            ],
            [
                'id'    => '86',
                'title' => 'income_access',
            ],
            [
                'id'    => '87',
                'title' => 'expense_report_create',
            ],
            [
                'id'    => '88',
                'title' => 'expense_report_edit',
            ],
            [
                'id'    => '89',
                'title' => 'expense_report_show',
            ],
            [
                'id'    => '90',
                'title' => 'expense_report_delete',
            ],
            [
                'id'    => '91',
                'title' => 'expense_report_access',
            ],
            [
                'id'    => '92',
                'title' => 'employee_create',
            ],
            [
                'id'    => '93',
                'title' => 'employee_edit',
            ],
            [
                'id'    => '94',
                'title' => 'employee_show',
            ],
            [
                'id'    => '95',
                'title' => 'employee_delete',
            ],
            [
                'id'    => '96',
                'title' => 'employee_access',
            ],
            [
                'id'    => '97',
                'title' => 'business_unit_create',
            ],
            [
                'id'    => '98',
                'title' => 'business_unit_edit',
            ],
            [
                'id'    => '99',
                'title' => 'business_unit_show',
            ],
            [
                'id'    => '100',
                'title' => 'business_unit_delete',
            ],
            [
                'id'    => '101',
                'title' => 'business_unit_access',
            ],
            [
                'id'    => '102',
                'title' => 'booking_management_access',
            ],
            [
                'id'    => '103',
                'title' => 'dormitory_booking_create',
            ],
            [
                'id'    => '104',
                'title' => 'dormitory_booking_edit',
            ],
            [
                'id'    => '105',
                'title' => 'dormitory_booking_show',
            ],
            [
                'id'    => '106',
                'title' => 'dormitory_booking_delete',
            ],
            [
                'id'    => '107',
                'title' => 'dormitory_booking_access',
            ],
            [
                'id'    => '108',
                'title' => 'venue_booking_create',
            ],
            [
                'id'    => '109',
                'title' => 'venue_booking_edit',
            ],
            [
                'id'    => '110',
                'title' => 'venue_booking_show',
            ],
            [
                'id'    => '111',
                'title' => 'venue_booking_delete',
            ],
            [
                'id'    => '112',
                'title' => 'venue_booking_access',
            ],
            [
                'id'    => '113',
                'title' => 'venue_package_create',
            ],
            [
                'id'    => '114',
                'title' => 'venue_package_edit',
            ],
            [
                'id'    => '115',
                'title' => 'venue_package_show',
            ],
            [
                'id'    => '116',
                'title' => 'venue_package_delete',
            ],
            [
                'id'    => '117',
                'title' => 'venue_package_access',
            ],
            [
                'id'    => '118',
                'title' => 'staycation_booking_create',
            ],
            [
                'id'    => '119',
                'title' => 'staycation_booking_edit',
            ],
            [
                'id'    => '120',
                'title' => 'staycation_booking_show',
            ],
            [
                'id'    => '121',
                'title' => 'staycation_booking_delete',
            ],
            [
                'id'    => '122',
                'title' => 'staycation_booking_access',
            ],
            [
                'id'    => '123',
                'title' => 'coworking_create',
            ],
            [
                'id'    => '124',
                'title' => 'coworking_edit',
            ],
            [
                'id'    => '125',
                'title' => 'coworking_show',
            ],
            [
                'id'    => '126',
                'title' => 'coworking_delete',
            ],
            [
                'id'    => '127',
                'title' => 'coworking_access',
            ],
        ];

        Permission::insert($permissions);
    }
}