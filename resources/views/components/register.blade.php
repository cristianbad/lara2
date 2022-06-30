<div>
    <p>Create an account</p>
    <form action="/users" method="POST">
        @csrf
        <div>
            <label for="name"> Name </label>
            <input type="text" name="name" value="{{ old('name') }}" />
            @error('name')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>

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

        <div>
            <label for="password_confirmation"> Confirm Password </label>
            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" />
            @error('password_confirmation')
                <p style="color: red">{{ $message }}</p>
            @enderror
        </div>


        <p> <button type="submit"> Sign Up </button> </p>

        <p> Already have an account? <a href="/login"> Login </a></p>

    </form>

</div>




{{-- @php
            $names = [
                [
                    'title' => 'Name',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => "{{ old('name') }}"
                ],
                [
                    'title' => 'Email',
                    'name' => 'email',
                    'type' => 'email',
                    'value' => "{{ old('email') }}"
                ],
                [
                    'title' => 'Password',
                    'name' => 'password',
                    'type' => 'password',
                    'value' => "{{ old('password') }}"
                ],
                [
                    'title' => 'Confirm Password',
                    'name' => 'password_confirmation',
                    'type' => 'password',
                    'value' => "{{ old('password_confirmation') }}"
                ],
            ];
        @endphp

        @foreach ($names as $name)
            <x-single-input :name="$name['name']" :title="$name['title']" :type="$name['type']" :value="$name['value']" />
        @endforeach --}}
