@php
    $searchQuery = request()->query('search');
@endphp

<!-- Search -->
<form action="/">
    <div>
        <input type="text" name="search" placeholder="{{ $searchQuery ?? 'Search materials' }}" />
        <div>
            <button type="submit">Search</button>   
        </div>
    </div>
</form>
