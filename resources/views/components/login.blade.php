<div>
    <p>Log into your account</p>
    <form action="/users/authenticate" method="POST">
        @csrf

        <div>
            <label for="email"> Email </label>
            <input type="email" name="email" value="{{ old('email') }}" />
            @error('email')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password"> Password </label>
            <input type="password" name="password" value="{{ old('password') }}" />
            @error('password')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

        <p><button type="submit">Sign In</button></p>
        <p> Dont have an account? <a href="/register">Register</a> </p>

    </form>

</div>




{{-- @php
            $names = [
                [
                    'title' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                    'value' => old('email')
                ],
                [
                    'title' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
                    'value' => old('password')
                ],
            ];
        @endphp

        @foreach ($names as $name)
            <x-single-input :name="$name['name']" :title="$name['title']" :type="$name['type']" :value="$name['value']"/>
        @endforeach --}}
