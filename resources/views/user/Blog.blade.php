@extends('user.temp.Main')

@section('Content')
<main>
    <!-- About US Start -->
    <div class="about-area2 gray-bg pt-60 pb-60">
        <div class="container">
                <div class="row">
                <div class="col-lg-8">
                    <div class="whats-news-wrapper">
                        <!-- Heading & Nav Button -->
                            <div class="row justify-content-between align-items-end ">
                                <div class="col-xl-12">
                                    <div class="section-tittle">
                                        <h4>
                                            <a href="/">Home</a>
                                            /<a href="/Blog">Blog</a>   
                                            @isset($BlogName)
                                            /<a href="/Blog/{{ $BlogName }}">{{ $BlogName }}</a>   
                                            @endisset
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab content -->
                            <div class="row p-3">
                                <div class="col-12">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">       
                                        <div class="row">
                                            <div id="quill-container" style="font-size: 18px;" class="ql-container ql-snow">
                                                <div class="ql-editor" >
                                                    {!! $container !!}
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            
                    </div>
                    <user-comment post_id="" blog_id="{{ $BlogId }}"/>
                    </div>
                    <div class="col-lg-4 p-3 mb-5 bg-body rounded">
                        <div class="blog_right_sidebar">
                            @include('user.temp.Search')

                            @include('user.temp.sidebarRight')                           
                           
                          
                        </div>
                     </div>
                </div>
        </div>
    </div>
    <!-- About US End -->
    <!--Start pagination -->
    @isset($Posts)
        @if ($Posts->hasPages())
            <div class="pagination-area  gray-bg pb-45">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="single-wrap">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination justify-content-start">
                                    <li class="page-item"><a class="page-link" href="{{ $Posts->previousPageUrl() }}">
                                        <!-- SVG icon -->
                                        <svg  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="15px">
                                            <path fill-rule="evenodd"  fill="rgb(255, 11, 11)" d="M8.142,13.118 L6.973,14.135 L0.127,7.646 L0.127,6.623 L6.973,0.132 L8.087,1.153 L2.683,6.413 L23.309,6.413 L23.309,7.856 L2.683,7.856 L8.142,13.118 Z"/>
                                            </svg>
                                    </span></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">Trang hi???n t???i : {{ $Posts->currentPage() }}</a></li>
                                        <li class="page-item active"><a class="page-link" href="/Post/{{ $Posts->lastPage() }}">trang cu???i : {{ $Posts->lastPage() }}</a></li>
                                    <li class="page-item"><a class="page-link" href="{{ $Posts->nextPageUrl() }}">
                                        <!-- SVG iocn -->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="15px">
                                        <path fill-rule="evenodd"  fill="rgb(255, 11, 11)" d="M31.112,13.118 L32.281,14.136 L39.127,7.646 L39.127,6.624 L32.281,0.132 L31.167,1.154 L36.571,6.413 L0.491,6.413 L0.491,7.857 L36.571,7.857 L31.112,13.118 Z"/>
                                        </svg>
                                    </span></a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endisset


    <!-- End pagination  -->
</main>
@endsection