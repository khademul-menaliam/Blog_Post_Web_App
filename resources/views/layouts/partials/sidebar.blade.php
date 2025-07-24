       <div class="blog_sidebar">
                        <div class="p-3 p-xl-4 border rounded">
                            <div class="card_header mb-4">
                                <h3>Categories</h3>
                            </div>
                            <div class="categories_list">
                                <ul>
                                    @foreach($category as $data)
                                        <li><a href="{{ route('category.show', $data->slug) }}">{{$data->title}} ({{ $data->posts_count ?? 0 }}) </a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 p-xl-4 border rounded mt-2">
                            <div class="card_header mb-4">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="latestpost_list">
                                 <ul>
                                    @foreach($latestPost as $data)
                                        <li><a href="{{ route('blog.show', $data->slug) }}">{{$data->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
        </div>
