<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $ManageCategory = new permission();
        $ManageCategory->name = 'Quản lý danh mục';
        $ManageCategory->slug = 'Manage-Category';
        $ManageCategory->save();

        $ManagePersonalBlog = new permission();
        $ManagePersonalBlog->name = 'Quản lý blog cá nhân';
        $ManagePersonalBlog->slug = 'Manage-Personal-blog';
        $ManagePersonalBlog->save();

        $ManageBlogAll = new permission();
        $ManageBlogAll->name = 'Quản lý tất cả bài blog';
        $ManageBlogAll->slug = 'Manage-blog-All';
        $ManageBlogAll->save();

        $ManagePersonalPosts = new permission();
        $ManagePersonalPosts->name = 'Quản lý viết cá nhân';
        $ManagePersonalPosts->slug = 'Manage-Personal-post';
        $ManagePersonalPosts->save();

        $ManagePostsAll = new permission();
        $ManagePostsAll->name = 'Quản lý tất cả bài viết';
        $ManagePostsAll->slug = 'Manage-post-All';
        $ManagePostsAll->save();

        $ManageInfoWeb = new permission();
        $ManageInfoWeb->name = 'Quản lý thông tin của web';
        $ManageInfoWeb->slug = 'Manage-Info-Web';
        $ManageInfoWeb->save();

        $ManageContact = new permission();
        $ManageContact->name = 'Quản lý liên hệ';
        $ManageContact->slug = 'Manage-contact';
        $ManageContact->save();

        $ManageReport = new permission();
        $ManageReport->name = 'Quản lý thống kê lượt truy cập';
        $ManageReport->slug = 'Manage-report';
        $ManageReport->save();

        $ManageAccount = new permission();
        $ManageAccount->name = 'Quản lý tài khoản';
        $ManageAccount->slug = 'Manage-Account';
        $ManageAccount->save();



        $admin_1_create = new User();
        $admin_1_create->name = 'Phạm nguyên hồng';
        $admin_1_create->email = 'admin1@gmail.com';
        $admin_1_create->birthday = '2000-01-23';
        $admin_1_create->address = 'hạ long quảng ninh';
        $admin_1_create->password = bcrypt('admin1');
        $admin_1_create->save();
        $admin_1_create->permissions()->attach($ManageCategory);
        $admin_1_create->permissions()->attach($ManagePersonalBlog);
        $admin_1_create->permissions()->attach($ManageBlogAll);
        $admin_1_create->permissions()->attach($ManageContact);
        $admin_1_create->permissions()->attach($ManagePersonalPosts);
        $admin_1_create->permissions()->attach($ManagePostsAll);
        $admin_1_create->permissions()->attach($ManageInfoWeb);
        $admin_1_create->permissions()->attach($ManageAccount);
        $admin_1_create->permissions()->attach($ManageReport);



    }
}
