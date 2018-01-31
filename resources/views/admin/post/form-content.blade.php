<div class="form-group">
    <label for="title" class="form-control-label">文章标题*</label>
    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title"
           value="{{ isset($post) ? $post->title : old('title') }}"
           autofocus>
    @if ($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('title') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="description" class="form-control-label">文章描述*</label>

    <textarea id="post-description-textarea" style="resize: vertical;" rows="3" spellcheck="false"
              id="description" class="form-control autosize-target{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="请使用 Markdown 格式书写"
              name="description">{{ isset($post) ? $post->description : old('description') }}</textarea>

    @if ($errors->has('description'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('description') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="slug" class="form-control-label">文章slug*</label>
    <input id="slug" type="text" class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}" name="slug"
           value="{{ isset($post) ? $post->slug : old('slug') }}">

    @if ($errors->has('slug'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('slug') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="categories" class="form-control-label">文章分类*</label>
    <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
        @foreach($categories as $category)
            @if((isset($post) ? $post->category_id : old('category_id',-1)) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
            @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('category_id'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('category_id') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="tags[]" class="form-control-label">文章标签</label>
    <select style="max-width: 99%" id="post-tags" name="tags[]" class="form-control{{ $errors->has('tags[]') ? ' is-invalid' : '' }}" multiple>
        @foreach($tags as $tag)
            @if(isset($post) && $post->tags->contains($tag))
                <option value="{{ $tag->name }}" selected>{{ $tag->name }}</option>
            @else
                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
            @endif
        @endforeach
    </select>

    @if ($errors->has('tags[]'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('tags[]') }}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="post-content-textarea" class="form-control-label">文章内容*</label>
    <textarea spellcheck="false" id="post-content-textarea" class="form-control{{ $errors->has('content') ? ' is-invalid ' : ' ' }}" name="content"
              rows="36"
              placeholder="请使用 Markdown 格式书写"
              style="resize: vertical">{{ isset($post) ? $post->content : old('content') }}</textarea>
    @if($errors->has('content'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content') }}</strong>
        </div>
    @endif
</div>

<div class="form-group">
    <label for="comment_info" class="form-control-label">评论信息</label>
    <select style="margin-top: 5px" id="comment_info" name="comment_info" class="form-control">
        <?php $comment_info = isset($post) ? $post->getConfig('comment_info', 'default') : 'default'?>
        <option value="default" {{ $comment_info=='default'?' selected' : '' }}>默认</option>
        <option value="force_disable" {{ $comment_info=='force_disable'?' selected' : '' }}>强制关闭显示评论</option>
        <option value="force_enable" {{ $comment_info=='force_enable'?' selected' : '' }}>强制开启显示评论</option>
    </select>
</div>
<div class="form-group">
    <label for="comment_type" class="form-control-label">评论类型</label>
    <select id="comment_type" name="comment_type" class="form-control">
        <?php $comment_type = isset($post) ? $post->getConfig('comment_type', 'default') : 'default'?>
        <option value="default" {{ $comment_type=='default'?' selected' : '' }}>默认</option>
        <option value="raw" {{ $comment_type=='raw'?' selected' : '' }}>自带评论</option>
        <option value="disqus" {{ $comment_type=='disqus'?' selected' : '' }}>Disqus</option>
        <option value="duoshuo" {{ $comment_type=='duoshuo'?' selected' : '' }}>多说</option>
    </select>
</div>

<div class="form-group">
    <label for="allow_resource_comment" class="form-control-label">是否允许评论</label>
    <select id="allow_resource_comment" name="allow_resource_comment" class="form-control">
        <?php $allow_resource_comment = isset($post) ? $post->getConfig('allow_resource_comment', 'default') : 'default'?>
        <option value="default" {{ $allow_resource_comment=='default'?' selected' : '' }}>默认</option>
        <option value="false" {{ $allow_resource_comment=='false'?' selected' : '' }}>禁止评论</option>
        <option value="true" {{ $allow_resource_comment=='true'?' selected' : '' }}>允许评论</option>
    </select>
</div>

<div class="form-group">
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (isset($post)) && $post->status == 1 ? ' checked ':'' }}
                   name="status"
                   value="1">发布
        </label>
    </div>
    <div class="radio radio-inline">
        <label>
            <input type="radio"
                   {{ (!isset($post)) || $post->status == 0 ? ' checked ':'' }}
                   name="status"
                   value="0">草稿
        </label>
    </div>
</div>
{{ csrf_field() }}