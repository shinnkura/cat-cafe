<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBlogRequest;
use App\Http\Requests\Admin\UpdateBlogRequest;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class AdminBlogController extends Controller
{
    /**
     * ブログ一覧画面
     */
    public function index()
    {
        // $blogs = Blog::latest('updated_at')->paginate(10);
        // 前後のページのみを表示
        $blogs = Blog::latest('updated_at')->simplePaginate(10);
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
     * 
     * ルートモデル結合を使用
     * ・型指定をする際、モデルを指定することで、そのモデルのメソッドを使用できる
     * ・つまり、BlogモデルのfindOrFailメソッドを使用できる
     * ・findOrFailメソッドは、指定したIDのデータが存在しない場合、404エラーを返す
     */
    public function edit(Blog $blog)
    {
        $categories = Category::all();
        // $blog = Blog::findOrFail($id);
        // return view('admin.blogs.edit', ['blog' => $blog]);
        return view('admin.blogs.edit', ['blog' => $blog, 'categories' => $categories]);
    }

    /**
     * 指定したIDのブログ更新処理
     */
    public function update(UpdateBlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $updateData = $request->validated();

        //　画像を変更する場合
        if ($request->has('image')) {
            // 変更前の画像を削除
            Storage::disk('public')->delete($blog->image);
            // 新しい画像を保存
            $updateData['image'] = $request->file('image')->store('blogs', 'public');
        }
        $blog->category()->associate($updateData['category_id']);
        $blog->update($updateData);

        return to_route('admin.blogs.index')->with('success', 'ブログを更新しました');
    }

    /**
     * 指定したIDのブログを削除する
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        Storage::disk('public')->delete($blog->image);
        $blog->delete();

        return to_route('admin.blogs.index')->with('success', 'ブログを削除しました');
    }
}
