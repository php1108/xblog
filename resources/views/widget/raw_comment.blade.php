<div class="comments" id="comments">
    <div class="comments-body">
        <div id="comments-container"
             data-api-url="{{ route('comment.show',[$commentable->id,
             'commentable_type'=>$commentable_type,
             'redirect'=>(isset($redirect) && $redirect ? $redirect:'')]) }}">
            @if(isset($comments) && !empty($comments))
                @include('comment.show',$comments)
            @endif
        </div>
        <form id="comment-form" method="post" action="{{ route('comment.store') }}">
            {{ csrf_field() }}
            <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">
            <input type="hidden" name="commentable_type" value="{{ $commentable_type }}">
            <?php $final_allow_comment = $commentable->allowComment()?>
            @if(!auth()->check())
                <div class="form-group">
                    <label class="form-control-label" for="username">姓名<span class="text-danger">*</span></label>
                    <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="username" type="text" name="username" placeholder="您的大名">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="email">邮箱<span class="text-danger">*</span></label>
                    <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="email" type="email" name="email" placeholder="邮箱不会公开">
                </div>
                <div class="form-group">
                    <label class="form-control-label" for="site">个人网站</label>
                    <input {{ $final_allow_comment?' ':' disabled ' }} class="form-control" id="site" type="text" name="site" placeholder="可选，填写后点击头像可以直接进入">
                </div>
            @endif
            <div class="form-group">
                <label for="comment-content">评论内容<span class="text-danger">*</span></label>
                <textarea {{ $final_allow_comment?' ':' disabled ' }} placeholder="支持Markdown, 审核后才会显示"
                          id="comment-content" name="content"
                          rows="5" spellcheck="false"
                          class="form-control markdown-content autosize-target"></textarea>
            </div>
            @if($final_allow_comment)
                <div class="form-group d-flex">
                    <img id="captcha" class="mr-3" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()">
                    <input class="form-control" type="text" name="captcha">
                </div>
            @endif
            <div class="form-group">
                <span class="help-block required"><strong id="comment_submit_msg"></strong></span>
            </div>
            <div class="form-group">
                <input {{ $final_allow_comment?' ':' disabled ' }} type="submit" id="comment-submit" class="btn btn-primary"
                       value="回复"/>
            </div>
        </form>
    </div>
</div>