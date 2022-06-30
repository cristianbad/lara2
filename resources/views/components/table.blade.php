@props(['materials'])

<table>
    <tr>
        <th>Can modify?</th>
        <th><a href="/orderby/id">ID(click to order by)</a></th>
        <th><a href="/orderby/user_id">User</a></th>
        <th><a href="/orderby/name">Name</a></th>
        <th><a href="/orderby/quantity">Quntity</a></th>
        <th><a href="/orderby/code">Code</a></th>
        <th><a href="/orderby/type">Type</a></th>
    </tr>
    @foreach ($materials as $material)
        <tr>
            <th>
                @if (auth()->user()->isAdmin)
                    <span style="color: green">YES</span>
                @else
                    {!! auth()->user()->id == $material->user_id ? '<span style="color: green">YES</span>' : '<span style="color: red">NO</span>' !!}
                @endif

            </th>

            <th>{{ $material->id }}</th>
            <th>{{ $material->user->name }}</th>
            <th>{{ $material->name }}</th>
            <th>{{ $material->quantity }}</th>
            <th>{{ $material->code }}</th>
            <th>{{ $material->type }}</th>
            <th>
                <form action="/materials/{{ $material->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="color: red">Delete</button>
                </form>
            </th>
            <th>
                <a href="/materials/{{ $material->id }}/edit">
                    @csrf
                    <button style="color: green">Edit</button>
                </a>
            </th>
        </tr>
    @endforeach

</table>

@if (method_exists($materials, 'links'))
    <p style="max-height: 100px">
        <style>
            li {
                display: inline;
                font-size: 20px;
                padding: 10px;
            }
        </style>
        {{ $materials->links('pagination::bootstrap-4') }}
    </p>
@endif
