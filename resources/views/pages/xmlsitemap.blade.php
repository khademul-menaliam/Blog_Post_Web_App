<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Home --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Static Pages --}}
    <url><loc>{{ route('blogs.index') }}</loc></url>
    <url><loc>{{ route('about.us.index') }}</loc></url>
    <url><loc>{{ route('disclaimer.index') }}</loc></url>
    <url><loc>{{ route('privacy.index') }}</loc></url>
    <url><loc>{{ route('terms.index') }}</loc></url>
    <url><loc>{{ route('siteMap.index') }}</loc></url>

    {{-- Categories --}}
    @foreach($categories as $category)
        <url>
            <loc>{{ route('category.show', $category->slug) }}</loc>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Blog Posts --}}
    @foreach($blogs as $post)
        <url>
            <loc>{{ route('blog.show', $post->slug) }}</loc>
            <lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
