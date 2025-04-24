<!-- resources/views/blog/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h1 class="mb-4">{{ $article->title }}</h1>

    <p><strong>Category:</strong> {{ $article->category->name ?? 'N/A' }}</p>
    <p><strong>Tags:</strong> 
        @forelse($article->tags as $tag)
            <span class="badge badge-secondary">{{ $tag->name }}</span>
        @empty
            <em>No tags</em>
        @endforelse
    </p>

    <div>
        <strong>Content:</strong>
        <p>{{ $article->description }}</p> 
    </div>

</div>

</body>
</html>
