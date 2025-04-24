<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h1 class="mb-4">Blog</h1>

    {{-- Category Filter --}}
    <form method="GET" action="{{ route('blog.index') }}" class="mb-4">
        <div class="form-group">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category" class="form-control w-25 d-inline-block">
                <option value="">-- All Categories --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary ml-2">Filter</button>
        </div>
    </form>

    {{-- Article List --}}
    @forelse($articles as $article)
        <div class="card mb-3">
            <div class="card-body">
                <h5>
                    <a href="{{ route('blog.show', $article->id) }}">{{ $article->title }}</a>
                </h5>
                <p><strong>Category:</strong> {{ $article->category->name ?? 'N/A' }}</p>
                <p><strong>Tags:</strong> 
                    @forelse($article->tags as $tag)
                        <span class="badge badge-secondary">{{ $tag->name }}</span>
                    @empty
                        <em>No tags</em>
                    @endforelse
                </p>
            </div>
        </div>
    @empty
        <p>No articles found.</p>
    @endforelse

</div>

</body>
</html>
