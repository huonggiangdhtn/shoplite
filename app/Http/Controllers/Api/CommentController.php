<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $pagesize;

    public function __construct()
    {
        $this->pagesize = env('NUMBER_PER_PAGE', 20);
        $this->middleware('auth');
    }

    // Danh sách bình luận
    public function index()
    {
        $comments = Comment::orderBy('id', 'DESC')->paginate($this->pagesize);
        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }

    // Tạo mới bình luận
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'content' => 'required|string',
            'url' => 'required|url',
            'email' => 'nullable|email',
        ]);

        $comment = Comment::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được tạo thành công!',
            'data' => $comment,
        ], 201);
    }

    // Lấy thông tin chi tiết bình luận
    public function show($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tồn tại!',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $comment,
        ]);
    }

    // Cập nhật bình luận
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tồn tại!',
            ], 404);
        }

        $this->validate($request, [
            'name' => 'string|max:255',
            'content' => 'string',
            'url' => 'url',
            'email' => 'nullable|email',
        ]);

        $comment->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được cập nhật thành công!',
            'data' => $comment,
        ]);
    }

    // Xóa bình luận
    public function destroy($id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tồn tại!',
            ], 404);
        }

        $comment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bình luận đã được xóa thành công!',
        ]);
    }

    // Cập nhật trạng thái bình luận
    public function updateStatus(Request $request, $id)
    {
        $comment = Comment::find($id);

        if (!$comment) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tồn tại!',
            ], 404);
        }

        $status = $request->input('status') == 'active' ? 'active' : 'inactive';
        $comment->update(['status' => $status]);

        return response()->json([
            'success' => true,
            'message' => 'Trạng thái bình luận đã được cập nhật!',
            'data' => $comment,
        ]);
    }

    // Tìm kiếm bình luận
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng cung cấp từ khóa tìm kiếm!',
            ]);
        }

        $comments = Comment::where('content', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->orWhere('url', 'LIKE', '%' . $query . '%')
            ->paginate($this->pagesize);

        return response()->json([
            'success' => true,
            'data' => $comments,
        ]);
    }
}
