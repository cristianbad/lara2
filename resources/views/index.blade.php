<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>app</title>
    <style>
        table {
            border: solid 1px #aaa999;
        }

        table tr th {
            border: solid 1px #aaa999;
        }
    </style>
</head>

<body>


    {{-- Show success/fail create/update message --}}
    @if (session()->has('message'))
        <p style="color: red">
            {{ session('message') }}
        </p>
    @endif

    {{-- Show register form if /register accessed --}}
    @isset($wanaRegister)
        <x-register />
    @endisset

    {{-- Show login form if /login accessed --}}
    @isset($wanaLogin)
        <x-login />
    @endisset

    {{-- Show content if authenticated --}}
    @auth
        {{-- Welcome part user name, logout and home button --}}
        <label style="color: green">Welcome {{ auth()->user()->name }}, you are logged in as {{ auth()->user()->isAdmin ? 'an Admin' : 'a Guest'}}</label>

        <div>
            <style>
                div {
                    display: flex;
                    flex-direction: row;
                    justify-content: start padding: 10px;
                }
            </style>


            <div>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>

            <div> <a href="/"> <button>Home</button></a></div>
            <div> <a href="/accounts"> <button>Manage accounts</button></a></div>


        </div>

        {{-- Search part --}}
        <p>
            <x-search />
        </p>

        {{-- Tables with materials --}}
        <x-table :materials="$materials" />

        {{-- Create/update form --}}
        <p>
            <h2>{{ isset($editMaterial->name) ? 'Update material' : 'Create new material ' }}</h2>
        </p>
        <form action="/materials/{{ $editMaterial->id ?? '' }}" method="POST" enctype="multipart/form-data">
            @csrf

            @isset($editMaterial)
                @method('PUT')
            @endisset

            <div>
                <label for="material">Material Name</label>
                <input type="text" name="name" value="{{ $editMaterial->name ?? old('name') }}" />
                @error('name')
                    <label style="color: red">{{ $message }}</label>
                @enderror
            </div><br>
            <div>
                <label for="quantity">Material quantity</label>
                <input type="text" name="quantity" value="{{ $editMaterial->quantity ?? old('quantity') }}" />
                @error('quantity')
                    <label style="color: red">{{ $message }}</label>
                @enderror
            </div><br>
            <div>
                <label for="code">Material code</label>
                <input type="text" name="code" value="{{ $editMaterial->code ?? old('code') }}" />
                @error('code')
                    <label style="color: red">{{ $message }}</label>
                @enderror
            </div><br>
            <div>
                <label for="type">Material type</label>
                <input type="text" name="type" value="{{ $editMaterial->type ?? old('type') }}" />
                @error('type')
                    <label style="color: red">{{ $message }}</label>
                @enderror
            </div><br>

            <button type="submit">{{ isset($editMaterial->name) ? 'Update material' : 'Send new material' }}</button>
        </form>
    @else
        <a href="/login"><button>Click please</button></a>

    @endauth


</body>

</html>




{{-- @php
            $names = [
                [
                    'title' => 'Material Name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $editMaterial->name ?? "old('name')"
                ],
                [
                    'title' => 'Material quntity',
                    'name' => 'quntity',
                    'type' => 'text',
                    'value' => $editMaterial->quntity ?? "old('quntity')"

                ],
                [
                    'title' => 'Material code',
                    'name' => 'code',
                    'type' => 'text',
                    'value' => $editMaterial->code ?? "old('code')"

                ],
                [
                    'title' => 'Material type',
                    'name' => 'type',
                    'type' => 'text',
                    'value' => $editMaterial->type ?? "old('type')"

                ],
            ];
        @endphp

        @foreach ($names as $name)
            <x-single-input :name="$name['name']" :title="$name['title']" :type="$name['type']" :value="$name['value']" />
        @endforeach --}}
