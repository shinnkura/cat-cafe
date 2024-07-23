<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    /**
     * ブログ一覧画面
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blogs.index', ['blogs' => $blogs]);
    }

    /**
     * ブログ投稿画面
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * ブログ投稿処理
     */
    public function store(StoreBlogRequest $request)
    {
        // 画像はstorage/app/public/blogsに保存
        $saveImagePath = $request->file('image')->store('blogs', 'public');
        $blog = new Blog($request->validated());
        $blog->image = $saveImagePath;
        $blog->save();

        return to_route('admin.blogs.index')->with('success', 'ブログを投稿しました');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * 指定したIDのブログを編集する
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', ['blog' => $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
