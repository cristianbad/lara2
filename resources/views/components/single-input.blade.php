@props(['name', 'title', 'type'])


<div>
    <div>
        <label for="{{$name}}"> {{$title}} </label>
        <input type="{{$type}}" name="{{$name}}" value="{{$name}}" />
        @error('name')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>
</div>
