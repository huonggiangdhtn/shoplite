<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    /**
     * Lấy danh sách tất cả bài viết với phân trang.
     */
    public function getAllBlogList(Request $request)
    {
        // Phân trang với mặc định 10 bài mỗi trang
        $blogs = Blog::orderBy('created_at', 'desc')->paginate(10);

        // Chuyển đổi dữ liệu bài viết để đảm bảo đúng format
        $transformedBlogs = $blogs->getCollection()->transform(function ($blog) {
        $cleancontent = preg_replace('/<br\s*\/?>|<\/p>|<p>/', " ", $blog->content);
        $cleancontent = strip_tags($cleancontent); // Loại bỏ các thẻ HTML khác nếu có
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'summary' => $blog->summary,
                'content' => trim($cleancontent),
                'photo' => url($blog->photo), // Đảm bảo đường dẫn ảnh đầy đủ
                'created_at' => $blog->created_at->toDateTimeString(),
                'updated_at' => $blog->updated_at->toDateTimeString(),
            ];
        });

        // Trả về dữ liệu dưới dạng JSON với thông tin phân trang
        return response()->json([
            'status' => true,
            'message' => 'Danh sách bài viết',
            'data' => [
                'blogs' => $transformedBlogs,
                'pagination' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'per_page' => $blogs->perPage(),
                    'total' => $blogs->total(),
                ],
            ],
        ]);
    }

    /**
     * Lấy bài viết theo danh mục.
     */
    public function getBlogByCategory(Request $request)
    {
        // Kiểm tra cat_id trong request
        $validator = Validator::make($request->all(), [
            'cat_id' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Category ID is required and must be a number',
                'errors' => $validator->errors(),
            ], 400);
        }

        // Tìm danh mục theo cat_id
        $category = BlogCategory::find($request->cat_id);
        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found!',
            ], 404);
        }

        // Lấy bài viết theo danh mục với phân trang
        $blogs = Blog::where('cat_id', $category->id)
            ->where('status', 'active')
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Danh sách bài viết theo danh mục',
            'data' => [
                'blogs' => $blogs->items(),
                'pagination' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'per_page' => $blogs->perPage(),
                    'total' => $blogs->total(),
                ],
            ],
        ]);
    }

    /**
     * Lấy tất cả danh mục bài viết.
     */
    public function getAllBlogCategories(Request $request)
    {
        // Lấy tất cả danh mục bài viết có trạng thái 'active'
        $categories = BlogCategory::where('status', 'active')->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Danh sách danh mục bài viết',
            'data' => [
                'categories' => $categories->items(),
                'pagination' => [
                    'current_page' => $categories->currentPage(),
                    'last_page' => $categories->lastPage(),
                    'per_page' => $categories->perPage(),
                    'total' => $categories->total(),
                ],
            ],
        ]);
    }

    /**
     * Lấy chi tiết bài viết theo ID.
     */
    public function getBlogDetails($id)
    {
        // Tìm bài viết theo ID
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found!',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Chi tiết bài viết',
            'data' => [
                'id' => $blog->id,
                'title' => $blog->title,
                'summary' => $blog->summary,
                'content' => $blog->content,
                'photo' => url($blog->photo),
                'created_at' => $blog->created_at->toDateTimeString(),
                'updated_at' => $blog->updated_at->toDateTimeString(),
            ],
        ]);
    }

    /**
     * Tìm kiếm bài viết theo từ khóa.
     */
    public function searchBlog(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ request
        $searchQuery = $request->input('search_query');

        if (!$searchQuery) {
            return response()->json([
                'status' => false,
                'message' => 'Search query is required.',
            ], 400);
        }

        // Tìm kiếm bài viết theo tiêu đề hoặc nội dung
        $blogs = Blog::where('title', 'like', '%' . $searchQuery . '%')
            ->orWhere('content', 'like', '%' . $searchQuery . '%')
            ->paginate(10);

        return response()->json([
            'status' => true,
            'message' => 'Kết quả tìm kiếm bài viết',
            'data' => [
                'blogs' => $blogs->items(),
                'pagination' => [
                    'current_page' => $blogs->currentPage(),
                    'last_page' => $blogs->lastPage(),
                    'per_page' => $blogs->perPage(),
                    'total' => $blogs->total(),
                ],
            ],
        ]);
    }
}
