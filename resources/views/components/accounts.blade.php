<style>
    table {
        border: solid 1px #aaa999;
    }

    table tr th {
        border: solid 1px #aaa999;
    }
</style>

<div> <a href="/"> <button>Home</button></a></div>

<table>
    <tr>
        <th>Can modify?</th>
        <th><a href="/accounts/id">ID(click to order by)</a></th>
        <th><a href="/accounts/name">Name</a></th>
        <th><a href="/accounts/email">Email</a></th>
        <th><a href="/accounts/isAdmin">isAdmin</a></th>
    </tr>
    @foreach ($accounts as $account)
        <tr>
            <th>
                <span style="color: green">YES</span>
            </th>

            <th>{{ $account->id }}</th>
            <th>{{ $account->name }}</th>
            <th>{{ $account->email }}</th>
            <th>{{ $account->isAdmin }}</th>

            <th>
                <form action="/accounts/{{ $account->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button style="color: red">Delete</button>
                </form>
            </th>
        </tr>
    @endforeach


</table>

@if (method_exists($account, 'links'))
    <p style="max-height: 100px">
        <style>
            li {
                display: inline;
                font-size: 20px;
                padding: 10px;
            }
        </style>
        {{ $account->links('pagination::bootstrap-4') }}
    </p>
@endif