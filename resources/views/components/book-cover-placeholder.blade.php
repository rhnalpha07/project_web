@props(['title' => 'Book Title', 'author' => 'Author Name'])

<div {{ $attributes->merge(['class' => 'book-cover-placeholder']) }} style="position: relative; width: 100%; height: 100%; background: linear-gradient(45deg, #6a11cb 0%, #2575fc 100%); color: white; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; padding: 10px;">
    <div style="font-size: 30px; margin-bottom: 10px;"><i class="fas fa-book"></i></div>
    <div style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">{{ Str::limit($title, 20) }}</div>
    <div style="font-size: 12px; opacity: 0.8;">{{ Str::limit($author, 20) }}</div>
</div> 