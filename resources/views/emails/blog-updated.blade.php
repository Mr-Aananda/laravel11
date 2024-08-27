<!DOCTYPE html>
<html>
<head>
    <title>Blog Post Updated</title>
</head>
<body>
    <p>Hello {{ $blog->user->name }},</p>
    <p>Your blog post titled <strong>"{{ $blog->title }}"</strong> has been updated by {{ $updatedBy->name }}.</p>
    <p>You can view the updated post <a href="{{ route('blog.show', $blog->id) }}">here</a>.</p>
    <p>Thank you!</p>
</body>
</html>
