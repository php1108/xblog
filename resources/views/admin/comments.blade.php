@extends('admin.layouts.app')
@section('title','Comments')
@section('content')
@section('action')
    <button class="btn btn-outline-danger swal-dialog-target"
            data-dialog-msg="Delete all unverified comments? "
            data-url="{{ route('comment.delete-un-verified') }}"
            data-method="delete">Delete Un Verified
    </button>
@endsection
@if($comments->isEmpty())
    <h3 class="center-block meta-item">No Comments</h3>
@else
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>用户</th>
            <th>Email</th>
            <th>地址</th>
            <th>状态</th>
            <th>IP</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            <?php $commentableData = $comment->getCommentableData();?>
            <tr>
                <td>
                    @if($comment->user_id)
                        <a href="{{ route('user.show',$comment->username) }}">{{ $comment->username }}</a>
                    @else
                        {{ $comment->username }}
                    @endif
                </td>
                <td><a href="mailto:{{ $comment->email }}">{{ $comment->email }}</a></td>
                <td>
                    @if($commentableData['deleted'])
                        <span data-html="true" data-toggle="tooltip" title="{{ $comment->html_content }}">{{ $commentableData['type'] }}已删除</span>
                    @else
                        @if($comment->trashed())
                            <span data-html="true" data-toggle="tooltip" title="{{ $comment->html_content }}">{{ $commentableData['title'] }}</span>
                        @else
                            <a data-html="true" data-toggle="tooltip" title="{{ $comment->html_content }}" target="_blank" href="{{ $commentableData['url'].'#comment-'.$comment->id }}">{{$commentableData['title'] }}
                            </a>
                        @endif
                    @endif
                </td>
                <td><span class="p-2 p badge {{ $comment->trashed() ? 'badge-danger':($comment->isVerified() ? 'badge-success' : 'badge-secondary') }}">{{ $comment->trashed() ? '已删除':($comment->isVerified() ? '已审核' : '未审核') }}</span></td>
                <td>{{ $comment->ip_id?$comment->ip_id:'NONE' }}</td>
                <td>
                    @if($comment->trashed())
                        <button type="submit"
                                class="btn btn-danger swal-dialog-target"
                                data-dialog-msg="永久删除这条评论？"
                                data-url="{{ route('comment.destroy',[$comment->id,'force'=>'true']) }}"
                                data-method="delete"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="永久删除">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </button>
                        <form class="d-inline-block" method="post" action="{{ route('comment.restore',$comment->id) }}">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="恢复">
                                <i class="fa fa-repeat fa-fw"></i>
                            </button>
                        </form>
                    @else
                        <button type="submit"
                                class="btn btn-danger swal-dialog-target"
                                data-dialog-msg="确定删除此评论？"
                                data-toggle="tooltip"
                                data-url="{{ route('comment.destroy',$comment->id) }}"
                                title="删除">
                            <i class="fa fa-trash-o fa-fw"></i>
                        </button>
                        <a class="btn btn-info"
                           href="{{ route('comment.edit',[$comment->id,'redirect'=>request()->fullUrl()]) }}">
                            <i class="fa fa-pencil fa-fw"></i>
                        </a>
                    @endif
                    <form class="d-inline-block" method="post"
                          action="{{ route('comment.verify',$comment->id) }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info"
                                data-toggle="tooltip" data-placement="top"
                                title="{{ $comment->isVerified()?'Un Verify':'Verify' }}">
                            <i class="fa fa-{{ $comment->isVerified()?'hand-o-down':'hand-o-up' }} fa-fw"></i>
                        </button>
                    </form>
                    <?php $ip = $comment->ip?$comment->ip:$comment->ip_id ?>
                    @if($ip == null)
                        <button disabled
                                class="btn btn-default"
                                data-toggle="tooltip"
                                title="NO IP">
                            <i class="fa fa-close fa-fw"></i>
                        </button>
                    @else
                        @include('admin.partials.ip_button',['ip'=>$ip])
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if($comments->lastPage() > 1)
        {{ $comments->links() }}
    @endif
@endif
@endsection
