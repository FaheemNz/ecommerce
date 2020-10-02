<section class="blog-banner-area" id="category">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>{{ isset($title) ? $title : 'Shopping Cart' }}</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        @if( isset($link1) )
                        <?php $link = explode('|', $link1) ?>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ $link[0] }}">{{ $link[1] }}</a>
                        </li>
                        @endif
                        @if( isset($link2) )
                        <li class="breadcrumb-item active" aria-current="page">{{ $link2 }}</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>