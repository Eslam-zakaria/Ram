<?php

namespace Modules\Comment\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Comment\Constants\CommentStatus;
use Modules\Comment\Models\Comment;

class CommentController extends Controller
{
    private $viewsPath = 'Comment.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function create()
    {
        return view($this->viewsPath.'create');
    }


    public function approve(Comment $comment, Request $request)
    {
        $comment->status = CommentStatus::APPROVED;
        $comment->save();

        return redirect()->route('admin.comments.index')->with(['success' => 'Updated Successfully']);
    }

    public function disapprove(Comment $comment, Request $request)
    {
        $comment->status = CommentStatus::DISAPPROVED;
        $comment->save();

        return redirect()->route('admin.comments.index')->with(['success' => 'Updated Successfully']);
    }
}

