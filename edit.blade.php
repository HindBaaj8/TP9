<h1>Modifier Speaker</h1>

<form action="/speakers/{{ $speaker->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>Name:</label>
    <input type="text" name="name" value="{{ $speaker->name }}"><br>
    <label>Bio:</label>
    <textarea name="bio">{{ $speaker->bio }}</textarea><br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $speaker->email }}"><br>
    <button type="submit">Modifier</button>
</form>
