<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard-view',
            'dashboard-admin-view',
            'dashboard-writer-view',
            'dashboard-mentor-view',

            'account-management',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'mentor-list',
            'mentor-create',
            'mentor-edit',
            'mentor-delete',

            'writer-list',
            'writer-create',
            'writer-edit',
            'writer-delete',

            'student-list',
            'student-create',
            'student-edit',
            'student-delete',

            'article-management',

            'article-list',
            'article-create',
            'article-edit',
            'article-delete',

            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',

            'article-tag-list',
            'article-tag-create',
            'article-tag-edit',
            'article-tag-delete',

            'university-management',

            'university-list',
            'university-create',
            'university-edit',
            'university-delete',

            'faculty-list',
            'faculty-create',
            'faculty-edit',
            'faculty-delete',

            'course-management',

            'course-category-list',
            'course-category-create',
            'course-category-edit',
            'course-category-delete',

            'course-list',
            'course-create',
            'course-edit',
            'course-delete',

            'transaction-management',

            'transaction-edit',
        ];

        $admin = Role::firstOrCreate(['name' => 'admin']);

        $writer = Role::firstOrCreate(['name' => 'writer']);

        $mentor = Role::firstOrCreate(['name' => 'mentor']);

        $student = Role::firstOrCreate(['name' => 'student']);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin->syncPermissions([
            'dashboard-view',

            'dashboard-admin-view',

            'account-management',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'mentor-list',
            'mentor-create',
            'mentor-edit',
            'mentor-delete',

            'writer-list',
            'writer-create',
            'writer-edit',
            'writer-delete',

            'student-list',
            'student-create',
            'student-edit',
            'student-delete',

            'article-management',

            'article-list',
            'article-create',
            'article-edit',
            'article-delete',

            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',

            'article-tag-list',
            'article-tag-create',
            'article-tag-edit',
            'article-tag-delete',

            'university-management',

            'university-list',
            'university-create',
            'university-edit',
            'university-delete',

            'faculty-list',
            'faculty-create',
            'faculty-edit',
            'faculty-delete',

            'course-management',

            'course-category-list',
            'course-category-create',
            'course-category-edit',
            'course-category-delete',

            'course-list',
            'course-create',
            'course-edit',
            'course-delete',

            'transaction-management',

            'transaction-edit',
        ]);

        $writer->syncPermissions([
            'dashboard-view',

            'dashboard-writer-view',

            'article-management',

            'article-list',
            'article-create',
            'article-edit',
            'article-delete',

            'article-category-list',
            'article-category-create',
            'article-category-edit',
            'article-category-delete',

            'article-tag-list',
            'article-tag-create',
            'article-tag-edit',
            'article-tag-delete',
        ]);

        $student->syncPermissions([
            'dashboard-view',
        ]);

        $mentor->syncPermissions([
            'dashboard-view',

            'dashboard-mentor-view',

            'course-management',

            'course-category-list',
            'course-category-create',
            'course-category-edit',
            'course-category-delete',

            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
        ]);
    }
}
