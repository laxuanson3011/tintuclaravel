<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Comment;
use App\TinTuc;


class CommentController extends Controller
{
  public function getXoa($id, $idTinTuc)
  {
      $comment = Comment::find($id);
      $comment->delete();
      return redirect('admin/tintuc/sua/'.$idTinTuc)->with('thongbaocm','Bạn Đã Xóa Comment Thành Công !!!');
  }
  public function postComment($id,Request $request)
  {
      $idTinTuc = $id;
      $tintuc = TinTuc::find($id);
      $comment = new Comment;
      $comment->idTinTuc = $idTinTuc;
      $comment->idUser = Auth::user()->id;
      $comment->NoiDung = $request->NoiDung;
      $comment->save();

      return redirect("pages/tintuc/$id/ ".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Viết Bình Luận Thành Công !!!');
  }
}
