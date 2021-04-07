<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'global_var_access',
            ],
            [
                'id'    => 24,
                'title' => 'department_create',
            ],
            [
                'id'    => 25,
                'title' => 'department_edit',
            ],
            [
                'id'    => 26,
                'title' => 'department_show',
            ],
            [
                'id'    => 27,
                'title' => 'department_delete',
            ],
            [
                'id'    => 28,
                'title' => 'department_access',
            ],
            [
                'id'    => 29,
                'title' => 'city_create',
            ],
            [
                'id'    => 30,
                'title' => 'city_edit',
            ],
            [
                'id'    => 31,
                'title' => 'city_show',
            ],
            [
                'id'    => 32,
                'title' => 'city_delete',
            ],
            [
                'id'    => 33,
                'title' => 'city_access',
            ],
            [
                'id'    => 34,
                'title' => 'device_create',
            ],
            [
                'id'    => 35,
                'title' => 'device_edit',
            ],
            [
                'id'    => 36,
                'title' => 'device_show',
            ],
            [
                'id'    => 37,
                'title' => 'device_delete',
            ],
            [
                'id'    => 38,
                'title' => 'device_access',
            ],
            [
                'id'    => 39,
                'title' => 'document_type_create',
            ],
            [
                'id'    => 40,
                'title' => 'document_type_edit',
            ],
            [
                'id'    => 41,
                'title' => 'document_type_show',
            ],
            [
                'id'    => 42,
                'title' => 'document_type_delete',
            ],
            [
                'id'    => 43,
                'title' => 'document_type_access',
            ],
            [
                'id'    => 44,
                'title' => 'operadore_access',
            ],
            [
                'id'    => 45,
                'title' => 'operator_create',
            ],
            [
                'id'    => 46,
                'title' => 'operator_edit',
            ],
            [
                'id'    => 47,
                'title' => 'operator_show',
            ],
            [
                'id'    => 48,
                'title' => 'operator_delete',
            ],
            [
                'id'    => 49,
                'title' => 'operator_access',
            ],
            [
                'id'    => 50,
                'title' => 'tag_create',
            ],
            [
                'id'    => 51,
                'title' => 'tag_edit',
            ],
            [
                'id'    => 52,
                'title' => 'tag_show',
            ],
            [
                'id'    => 53,
                'title' => 'tag_delete',
            ],
            [
                'id'    => 54,
                'title' => 'tag_access',
            ],
            [
                'id'    => 55,
                'title' => 'educational_background_access',
            ],
            [
                'id'    => 56,
                'title' => 'background_process_create',
            ],
            [
                'id'    => 57,
                'title' => 'background_process_edit',
            ],
            [
                'id'    => 58,
                'title' => 'background_process_show',
            ],
            [
                'id'    => 59,
                'title' => 'background_process_delete',
            ],
            [
                'id'    => 60,
                'title' => 'background_process_access',
            ],
            [
                'id'    => 61,
                'title' => 'referencium_access',
            ],
            [
                'id'    => 62,
                'title' => 'reference_type_create',
            ],
            [
                'id'    => 63,
                'title' => 'reference_type_edit',
            ],
            [
                'id'    => 64,
                'title' => 'reference_type_show',
            ],
            [
                'id'    => 65,
                'title' => 'reference_type_delete',
            ],
            [
                'id'    => 66,
                'title' => 'reference_type_access',
            ],
            [
                'id'    => 67,
                'title' => 'reference_object_create',
            ],
            [
                'id'    => 68,
                'title' => 'reference_object_edit',
            ],
            [
                'id'    => 69,
                'title' => 'reference_object_show',
            ],
            [
                'id'    => 70,
                'title' => 'reference_object_delete',
            ],
            [
                'id'    => 71,
                'title' => 'reference_object_access',
            ],
            [
                'id'    => 72,
                'title' => 'entity_create',
            ],
            [
                'id'    => 73,
                'title' => 'entity_edit',
            ],
            [
                'id'    => 74,
                'title' => 'entity_show',
            ],
            [
                'id'    => 75,
                'title' => 'entity_delete',
            ],
            [
                'id'    => 76,
                'title' => 'entity_access',
            ],
            [
                'id'    => 77,
                'title' => 'courses_hook_create',
            ],
            [
                'id'    => 78,
                'title' => 'courses_hook_edit',
            ],
            [
                'id'    => 79,
                'title' => 'courses_hook_show',
            ],
            [
                'id'    => 80,
                'title' => 'courses_hook_delete',
            ],
            [
                'id'    => 81,
                'title' => 'courses_hook_access',
            ],
            [
                'id'    => 82,
                'title' => 'course_create',
            ],
            [
                'id'    => 83,
                'title' => 'course_edit',
            ],
            [
                'id'    => 84,
                'title' => 'course_show',
            ],
            [
                'id'    => 85,
                'title' => 'course_delete',
            ],
            [
                'id'    => 86,
                'title' => 'course_access',
            ],
            [
                'id'    => 87,
                'title' => 'contract_create',
            ],
            [
                'id'    => 88,
                'title' => 'contract_edit',
            ],
            [
                'id'    => 89,
                'title' => 'contract_show',
            ],
            [
                'id'    => 90,
                'title' => 'contract_delete',
            ],
            [
                'id'    => 91,
                'title' => 'contract_access',
            ],
            [
                'id'    => 92,
                'title' => 'points_rule_create',
            ],
            [
                'id'    => 93,
                'title' => 'points_rule_edit',
            ],
            [
                'id'    => 94,
                'title' => 'points_rule_show',
            ],
            [
                'id'    => 95,
                'title' => 'points_rule_delete',
            ],
            [
                'id'    => 96,
                'title' => 'points_rule_access',
            ],
            [
                'id'    => 97,
                'title' => 'challenge_create',
            ],
            [
                'id'    => 98,
                'title' => 'challenge_edit',
            ],
            [
                'id'    => 99,
                'title' => 'challenge_show',
            ],
            [
                'id'    => 100,
                'title' => 'challenge_delete',
            ],
            [
                'id'    => 101,
                'title' => 'challenge_access',
            ],
            [
                'id'    => 102,
                'title' => 'badge_create',
            ],
            [
                'id'    => 103,
                'title' => 'badge_edit',
            ],
            [
                'id'    => 104,
                'title' => 'badge_show',
            ],
            [
                'id'    => 105,
                'title' => 'badge_delete',
            ],
            [
                'id'    => 106,
                'title' => 'badge_access',
            ],
            [
                'id'    => 107,
                'title' => 'feedback_type_create',
            ],
            [
                'id'    => 108,
                'title' => 'feedback_type_edit',
            ],
            [
                'id'    => 109,
                'title' => 'feedback_type_show',
            ],
            [
                'id'    => 110,
                'title' => 'feedback_type_delete',
            ],
            [
                'id'    => 111,
                'title' => 'feedback_type_access',
            ],
            [
                'id'    => 112,
                'title' => 'programacion_de_ciclo_access',
            ],
            [
                'id'    => 113,
                'title' => 'course_schedule_create',
            ],
            [
                'id'    => 114,
                'title' => 'course_schedule_edit',
            ],
            [
                'id'    => 115,
                'title' => 'course_schedule_show',
            ],
            [
                'id'    => 116,
                'title' => 'course_schedule_delete',
            ],
            [
                'id'    => 117,
                'title' => 'course_schedule_access',
            ],
            [
                'id'    => 118,
                'title' => 'feedbacks_user_create',
            ],
            [
                'id'    => 119,
                'title' => 'feedbacks_user_edit',
            ],
            [
                'id'    => 120,
                'title' => 'feedbacks_user_show',
            ],
            [
                'id'    => 121,
                'title' => 'feedbacks_user_delete',
            ],
            [
                'id'    => 122,
                'title' => 'feedbacks_user_access',
            ],
            [
                'id'    => 123,
                'title' => 'courses_user_create',
            ],
            [
                'id'    => 124,
                'title' => 'courses_user_edit',
            ],
            [
                'id'    => 125,
                'title' => 'courses_user_show',
            ],
            [
                'id'    => 126,
                'title' => 'courses_user_delete',
            ],
            [
                'id'    => 127,
                'title' => 'courses_user_access',
            ],
            [
                'id'    => 128,
                'title' => 'challenges_user_create',
            ],
            [
                'id'    => 129,
                'title' => 'challenges_user_edit',
            ],
            [
                'id'    => 130,
                'title' => 'challenges_user_show',
            ],
            [
                'id'    => 131,
                'title' => 'challenges_user_delete',
            ],
            [
                'id'    => 132,
                'title' => 'challenges_user_access',
            ],
            [
                'id'    => 133,
                'title' => 'resources_library_access',
            ],
            [
                'id'    => 134,
                'title' => 'resources_category_create',
            ],
            [
                'id'    => 135,
                'title' => 'resources_category_edit',
            ],
            [
                'id'    => 136,
                'title' => 'resources_category_show',
            ],
            [
                'id'    => 137,
                'title' => 'resources_category_delete',
            ],
            [
                'id'    => 138,
                'title' => 'resources_category_access',
            ],
            [
                'id'    => 139,
                'title' => 'resources_subcategory_create',
            ],
            [
                'id'    => 140,
                'title' => 'resources_subcategory_edit',
            ],
            [
                'id'    => 141,
                'title' => 'resources_subcategory_show',
            ],
            [
                'id'    => 142,
                'title' => 'resources_subcategory_delete',
            ],
            [
                'id'    => 143,
                'title' => 'resources_subcategory_access',
            ],
            [
                'id'    => 144,
                'title' => 'subcategories_set_create',
            ],
            [
                'id'    => 145,
                'title' => 'subcategories_set_edit',
            ],
            [
                'id'    => 146,
                'title' => 'subcategories_set_show',
            ],
            [
                'id'    => 147,
                'title' => 'subcategories_set_delete',
            ],
            [
                'id'    => 148,
                'title' => 'subcategories_set_access',
            ],
            [
                'id'    => 149,
                'title' => 'resource_create',
            ],
            [
                'id'    => 150,
                'title' => 'resource_edit',
            ],
            [
                'id'    => 151,
                'title' => 'resource_show',
            ],
            [
                'id'    => 152,
                'title' => 'resource_delete',
            ],
            [
                'id'    => 153,
                'title' => 'resource_access',
            ],
            [
                'id'    => 154,
                'title' => 'event_access',
            ],
            [
                'id'    => 155,
                'title' => 'events_schedule_create',
            ],
            [
                'id'    => 156,
                'title' => 'events_schedule_edit',
            ],
            [
                'id'    => 157,
                'title' => 'events_schedule_show',
            ],
            [
                'id'    => 158,
                'title' => 'events_schedule_delete',
            ],
            [
                'id'    => 159,
                'title' => 'events_schedule_access',
            ],
            [
                'id'    => 160,
                'title' => 'events_attendant_create',
            ],
            [
                'id'    => 161,
                'title' => 'events_attendant_edit',
            ],
            [
                'id'    => 162,
                'title' => 'events_attendant_show',
            ],
            [
                'id'    => 163,
                'title' => 'events_attendant_delete',
            ],
            [
                'id'    => 164,
                'title' => 'events_attendant_access',
            ],
            [
                'id'    => 165,
                'title' => 'community_access',
            ],
            [
                'id'    => 166,
                'title' => 'meeting_create',
            ],
            [
                'id'    => 167,
                'title' => 'meeting_edit',
            ],
            [
                'id'    => 168,
                'title' => 'meeting_show',
            ],
            [
                'id'    => 169,
                'title' => 'meeting_delete',
            ],
            [
                'id'    => 170,
                'title' => 'meeting_access',
            ],
            [
                'id'    => 171,
                'title' => 'meeting_attendant_create',
            ],
            [
                'id'    => 172,
                'title' => 'meeting_attendant_edit',
            ],
            [
                'id'    => 173,
                'title' => 'meeting_attendant_show',
            ],
            [
                'id'    => 174,
                'title' => 'meeting_attendant_delete',
            ],
            [
                'id'    => 175,
                'title' => 'meeting_attendant_access',
            ],
            [
                'id'    => 176,
                'title' => 'self_interested_access',
            ],
            [
                'id'    => 177,
                'title' => 'self_interested_user_create',
            ],
            [
                'id'    => 178,
                'title' => 'self_interested_user_edit',
            ],
            [
                'id'    => 179,
                'title' => 'self_interested_user_show',
            ],
            [
                'id'    => 180,
                'title' => 'self_interested_user_delete',
            ],
            [
                'id'    => 181,
                'title' => 'self_interested_user_access',
            ],
            [
                'id'    => 182,
                'title' => 'user_chain_block_create',
            ],
            [
                'id'    => 183,
                'title' => 'user_chain_block_edit',
            ],
            [
                'id'    => 184,
                'title' => 'user_chain_block_show',
            ],
            [
                'id'    => 185,
                'title' => 'user_chain_block_delete',
            ],
            [
                'id'    => 186,
                'title' => 'user_chain_block_access',
            ],
            [
                'id'    => 187,
                'title' => 'resources_audit_create',
            ],
            [
                'id'    => 188,
                'title' => 'resources_audit_edit',
            ],
            [
                'id'    => 189,
                'title' => 'resources_audit_show',
            ],
            [
                'id'    => 190,
                'title' => 'resources_audit_delete',
            ],
            [
                'id'    => 191,
                'title' => 'resources_audit_access',
            ],
            [
                'id'    => 192,
                'title' => 'report_access',
            ],
            [
                'id'    => 193,
                'title' => 'educational_bg_report_access',
            ],
            [
                'id'    => 194,
                'title' => 'communities_report_access',
            ],
            [
                'id'    => 195,
                'title' => 'general_report_access',
            ],
            [
                'id'    => 196,
                'title' => 'badges_user_create',
            ],
            [
                'id'    => 197,
                'title' => 'badges_user_edit',
            ],
            [
                'id'    => 198,
                'title' => 'badges_user_show',
            ],
            [
                'id'    => 199,
                'title' => 'badges_user_delete',
            ],
            [
                'id'    => 200,
                'title' => 'badges_user_access',
            ],
            [
                'id'    => 201,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
