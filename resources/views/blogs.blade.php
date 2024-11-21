
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style type="text/css">

    body {
        background-color: #eee;
        margin-top: 20px;
    }
    .media.media-news {
        display: flex;
        position: relative;
        padding-bottom: 210px;
    }
    @media (min-width: 768px) {
        .media.media-news {
            padding-bottom: 0;
            margin-bottom: 0;
        }
    }
    @media (min-width: 1200px) {
        .media.media-news {
            padding-bottom: 25px;
            margin-bottom: 0;
        }
    }
    .media.media-news .media-body {
        padding: 20px;
        box-shadow: 0 22px 28px 0 rgba(0, 0, 0, 0.06);
        background: #fff;
        position: absolute;
        width: 85%;
        right: 0;
        bottom: 0;
    }
    @media (min-width: 1200px) {
        .media.media-news .media-body {
            position: absolute;
            right: 35px;
            width: 60%;
            padding: 20px;
        }
    }
    .media.media-news .media-body .media-date {
        font-family: "Open Sans", sans-serif;
        color: #848484;
        margin-bottom: 10px;
    }
    .media.media-news .media-body h5 {
        font-size: 22px;
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    .media.media-news .media-body p {
        font-family: "Open Sans", sans-serif;
        color: #848484;
    }
    h5 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Number of lines before truncation */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal;
}
    .media-body p {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Number of lines before truncation */
    -webkit-box-orient: vertical;
    text-overflow: ellipsis;
    white-space: normal;
}
</style>

<div class="container">
    <div class="row no-gutters">
        @foreach($blogs as $blog)
            <div class="mb-4 col-xl-4 col-12">
                <div class="media media-news">
                    <div class="media-img">
                        <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="img-fluid" style="height: 300px; width:300px;">
                    </div>
                    <div class="media-body">
                        <span class="media-date">{{ $blog->created_at }}</span>
                        <h5 class="mt-0 sep">{{ $blog->title }}</h5>
                        <p>{!! \Illuminate\Support\Str::limit($blog->content, 60, '...') !!}</p>
                        <a href="" class="btn btn-transparent">View More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<?php

// echo $blogs;