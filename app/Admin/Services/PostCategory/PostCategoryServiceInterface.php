<?php

namespace App\Admin\Services\PostCategory;
use Illuminate\Http\Request;

interface PostCategoryServiceInterface
{
    /**
     * Tạo mới
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return mixed
     */
    public function store(Request $request);
    /**
     * Cập nhật
     * 
     * @var Illuminate\Http\Request $request
     * 
     * @return boolean
     */
    public function update(Request $request);
    /**
     * Xóa
     *  
     * @param int $id
     * 
     * @return boolean
     */
    public function delete($id);

}