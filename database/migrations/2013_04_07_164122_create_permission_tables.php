<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $teams = config('permission.teams');
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');
        $pivotRole = $columnNames['role_pivot_key'] ?? 'role_id';
        $pivotPermission = $columnNames['permission_pivot_key'] ?? 'permission_id';

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }
        if ($teams && empty($columnNames['team_foreign_key'] ?? null)) {
            throw new \Exception('Error: team_foreign_key on config/permission.php not loaded. Run [php artisan config:clear] and try again.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id'); // permission id
            $table->string('title');       // For MySQL 8.0 use string('name', 125);
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
			
			$table->unsignedBigInteger('module_id')->nullable();
			$table->foreign('module_id')->references('id')->on('modules')->onDelete('set null');
            
			$table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) use ($teams, $columnNames) {
            $table->bigIncrements('id'); // role id
            if ($teams || config('permission.testing')) { // permission.testing is a fix for sqlite testing
                $table->unsignedBigInteger($columnNames['team_foreign_key'])->nullable();
                $table->index($columnNames['team_foreign_key'], 'roles_team_foreign_key_index');
            }
            $table->string('title');       // For MySQL 8.0 use string('name', 125);
            $table->string('name');       // For MySQL 8.0 use string('name', 125);
            $table->string('guard_name'); // For MySQL 8.0 use string('guard_name', 125);
            $table->timestamps();
            if ($teams || config('permission.testing')) {
                $table->unique([$columnNames['team_foreign_key'], 'name', 'guard_name']);
            } else {
                $table->unique(['name', 'guard_name']);
            }
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotPermission, $teams) {
            $table->unsignedBigInteger($pivotPermission);

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_permissions_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            } else {
                $table->primary([$pivotPermission, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
            }

        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames, $pivotRole, $teams) {
            $table->unsignedBigInteger($pivotRole);

            $table->string('model_type')->default('App\Models\Admin');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');
            if ($teams) {
                $table->unsignedBigInteger($columnNames['team_foreign_key']);
                $table->index($columnNames['team_foreign_key'], 'model_has_roles_team_foreign_key_index');

                $table->primary([$columnNames['team_foreign_key'], $pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            } else {
                $table->primary([$pivotRole, $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
            }
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames, $pivotRole, $pivotPermission) {
            $table->unsignedBigInteger($pivotPermission);
            $table->unsignedBigInteger($pivotRole);

            $table->foreign($pivotPermission)
                ->references('id') // permission id
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign($pivotRole)
                ->references('id') // role id
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary([$pivotPermission, $pivotRole], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
			
			
		// seeding
			
		// roles
		DB::table('roles')->insert([
            'title' => 'Super Admin',
            'name' => 'superAdmin',
            'guard_name' => 'admin',
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		//modules
		DB::table('modules')->insert([
            'id' => 1,
            'name' => 'Quản lý Bài viết',
            'description' => '<p>Quản l&yacute; c&aacute;c B&agrave;i viết trong hệ thống</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 2,
            'name' => 'QL Chuyên mục Bài viết',
            'description' => '<p>Quản l&yacute; Chuy&ecirc;n mục B&agrave;i viết</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 3,
            'name' => 'Quản lý Vai trò',
            'description' => '<p>Quản l&yacute; Vai tr&ograve; tr&ecirc;n hệ thống</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 4,
            'name' => 'Quản lý Admin',
            'description' => '<p>Quản l&yacute; c&aacute;c quản trị vi&ecirc;n trong Hệ thống v&agrave; Ph&acirc;n vai tr&ograve; cho c&aacute;c Admin</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 5,
            'name' => 'Quản lý Thành viên',
            'description' => '<p>Quản l&yacute; Th&agrave;nh vi&ecirc;n</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 6,
            'name' => 'Quản lý Sản phẩm',
            'description' => '<p>Quản l&yacute; c&aacute;c th&ocirc;ng tin Sản phẩm của hệ thống</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 7,
            'name' => 'QL Thuộc tính Sản phẩm',
            'description' => '<p>QL Thuộc t&iacute;nh Sản phẩm</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 8,
            'name' => 'QL Danh mục Sản phẩm',
            'description' => '<p>Quản l&yacute; Danh mục Sản phẩm</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 9,
            'name' => 'Quản lý Đơn hàng',
            'description' => '<p>Quản l&yacute; Đơn h&agrave;ng</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 10,
            'name' => 'Quản lý Slider',
            'description' => '<p>Quản l&yacute; Slider c&aacute;c h&igrave;nh ảnh chạy qua lại ở trang Web b&ecirc;n ngo&agrave;i</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('modules')->insert([
            'id' => 11,
            'name' => 'Quản lý Slider Items',
            'description' => '<p>Quản l&yacute; c&aacute;c H&igrave;nh ảnh b&ecirc;n trong một Slider</p>',
            'status' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		// permissions
		DB::table('permissions')->insert([
			'id' => 1,
            'title' => 'Đọc tài liệu API',
            'name' => 'readAPIDoc',
            'guard_name' => 'admin',
            'module_id' => null,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);		
		DB::table('permissions')->insert([
			'id' => 2,
            'title' => 'Xem Bài viết',
            'name' => 'viewPost',
            'guard_name' => 'admin',
            'module_id' => 1,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);		
		DB::table('permissions')->insert([
			'id' => 3,
            'title' => 'Thêm Bài viết',
            'name' => 'createPost',
            'guard_name' => 'admin',
            'module_id' => 1,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
			'id' => 4,
            'title' => 'Sửa Bài viết',
            'name' => 'updatePost',
            'guard_name' => 'admin',
            'module_id' => 1,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);	
		DB::table('permissions')->insert([
			'id' => 5,
            'title' => 'Xóa Bài viết',
            'name' => 'deletePost',
            'guard_name' => 'admin',
            'module_id' => 1,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);

		DB::table('permissions')->insert([
			'id' => 6,
            'title' => 'Xem Vai Trò',
            'name' => 'viewRole',
            'guard_name' => 'admin',
            'module_id' => 3,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
			'id' => 7,
            'title' => 'Thêm Vai Trò',
            'name' => 'createRole',
            'guard_name' => 'admin',
            'module_id' => 3,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
			'id' => 8,
            'title' => 'Sửa Vai Trò',
            'name' => 'updateRole',
            'guard_name' => 'admin',
            'module_id' => 3,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		DB::table('permissions')->insert([
			'id' => 9,
            'title' => 'Xóa Vai Trò',
            'name' => 'deleteRole',
            'guard_name' => 'admin',
            'module_id' => 3,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 10,
            'title' => 'Xem Chuyên mục Bài viết',
            'name' => 'viewPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 11,
            'title' => 'Thêm Chuyên mục Bài viết',
            'name' => 'createPostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 12,
            'title' => 'Sửa Chuyên mục Bài viết',
            'name' => 'updatePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 13,
            'title' => 'Xóa Chuyên mục Bài viết',
            'name' => 'deletePostCategory',
            'guard_name' => 'admin',
            'module_id' => 2,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 14,
            'title' => 'Xem Admin',
            'name' => 'viewAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 15,
            'title' => 'Thêm Admin',
            'name' => 'createAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 16,
            'title' => 'Sửa Admin',
            'name' => 'updateAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 17,
            'title' => 'Xóa Admin',
            'name' => 'deleteAdmin',
            'guard_name' => 'admin',
            'module_id' => 4,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 18,
            'title' => 'Xem Thành viên',
            'name' => 'viewUser',
            'guard_name' => 'admin',
            'module_id' => 5,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 19,
            'title' => 'Thêm Thành viên',
            'name' => 'createUser',
            'guard_name' => 'admin',
            'module_id' => 5,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 20,
            'title' => 'Sửa Thành viên',
            'name' => 'updateUser',
            'guard_name' => 'admin',
            'module_id' => 5,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 21,
            'title' => 'Xóa Thành viên',
            'name' => 'deleteUser',
            'guard_name' => 'admin',
            'module_id' => 5,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 22,
            'title' => 'Xem Đơn hàng',
            'name' => 'viewOrder',
            'guard_name' => 'admin',
            'module_id' => 9,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 23,
            'title' => 'Thêm Đơn hàng',
            'name' => 'createOrder',
            'guard_name' => 'admin',
            'module_id' => 9,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 24,
            'title' => 'Sửa Đơn hàng',
            'name' => 'updateOrder',
            'guard_name' => 'admin',
            'module_id' => 9,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 25,
            'title' => 'Xóa Đơn hàng',
            'name' => 'deleteOrder',
            'guard_name' => 'admin',
            'module_id' => 9,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 26,
            'title' => 'Xem Sản phẩm',
            'name' => 'viewProduct',
            'guard_name' => 'admin',
            'module_id' => 6,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 27,
            'title' => 'Thêm Sản phẩm',
            'name' => 'createProduct',
            'guard_name' => 'admin',
            'module_id' => 6,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 28,
            'title' => 'Sửa Sản phẩm',
            'name' => 'updateProduct',
            'guard_name' => 'admin',
            'module_id' => 6,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 29,
            'title' => 'Xóa Sản phẩm',
            'name' => 'deleteProduct',
            'guard_name' => 'admin',
            'module_id' => 6,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 30,
            'title' => 'Xem Thuộc tính Sản phẩm',
            'name' => 'viewProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 7,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 31,
            'title' => 'Thêm Thuộc tính Sản phẩm',
            'name' => 'createProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 7,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 32,
            'title' => 'Sửa Thuộc tính Sản phẩm',
            'name' => 'updateProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 7,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 33,
            'title' => 'Xóa Thuộc tính Sản phẩm',
            'name' => 'deleteProductAttribute',
            'guard_name' => 'admin',
            'module_id' => 7,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		
		DB::table('permissions')->insert([
			'id' => 34,
            'title' => 'Xem Danh mục Sản phẩm',
            'name' => 'viewProductCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 35,
            'title' => 'Thêm Danh mục Sản phẩm',
            'name' => 'createProductCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 36,
            'title' => 'Sửa Danh mục Sản phẩm',
            'name' => 'updateProductCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 37,
            'title' => 'Xóa Danh mục Sản phẩm',
            'name' => 'deleteProductCategory',
            'guard_name' => 'admin',
            'module_id' => 8,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 38,
            'title' => 'Xem Slider',
            'name' => 'viewSlider',
            'guard_name' => 'admin',
            'module_id' => 10,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 39,
            'title' => 'Thêm Slider',
            'name' => 'createSlider',
            'guard_name' => 'admin',
            'module_id' => 10,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 40,
            'title' => 'Sửa Slider',
            'name' => 'updateSlider',
            'guard_name' => 'admin',
            'module_id' => 10,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 41,
            'title' => 'Xóa Slider',
            'name' => 'deleteSlider',
            'guard_name' => 'admin',
            'module_id' => 10,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 42,
            'title' => 'Xem Slider Item',
            'name' => 'viewSliderItem',
            'guard_name' => 'admin',
            'module_id' => 11,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 43,
            'title' => 'Thêm Slider Item',
            'name' => 'createSliderItem',
            'guard_name' => 'admin',
            'module_id' => 11,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 44,
            'title' => 'Sửa Slider Item',
            'name' => 'updateSliderItem',
            'guard_name' => 'admin',
            'module_id' => 11,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 45,
            'title' => 'Xóa Slider Item',
            'name' => 'deleteSliderItem',
            'guard_name' => 'admin',
            'module_id' => 11,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		
		DB::table('permissions')->insert([
			'id' => 46,
            'title' => 'Cài đặt chung',
            'name' => 'settingGeneral',
            'guard_name' => 'admin',
            'module_id' => null,
			'created_at' => DB::raw('NOW()'),
			'updated_at' => DB::raw('NOW()')
        ]);
		//seeding model_has_roles
		DB::table('model_has_roles')->insert([
			'role_id' => 1,
            'model_type' => 'AppModelsAdmin',
            'model_id' => 1
        ]);
		//seeding role_has_permissions
		DB::table('role_has_permissions')->insert([
			'permission_id' => 1,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 2,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 3,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 4,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 5,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 6,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 7,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 8,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 9,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 10,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 11,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 12,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 13,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 14,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 15,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 16,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 17,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 18,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 19,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 20,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 21,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 22,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 23,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 24,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 25,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 26,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 27,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 28,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 29,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 30,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 31,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 32,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 33,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 34,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 35,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 36,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 37,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 38,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 39,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 40,
            'role_id' => 1
        ]);DB::table('role_has_permissions')->insert([
			'permission_id' => 41,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 42,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 43,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 44,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 45,
            'role_id' => 1
        ]);
		DB::table('role_has_permissions')->insert([
			'permission_id' => 46,
            'role_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

		Schema::table('permissions', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['module_id']);
        });

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
};
