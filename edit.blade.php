<h1>Modifier Participant</h1>

<form action="/participants/{{ $participant->id }}" method="POST">
    @csrf
    @method('PUT')

    <label>First Name:</label>
    <input type="text" name="first_name" value="{{ $participant->first_name }}"><br>
    <label>Last Name:</label>
    <input type="text" name="last_name" value="{{ $participant->last_name }}"><br>
    <label>Email:</label>
    <input type="email" name="email" value="{{ $participant->email }}"><br>
    <label>Phone:</label>
    <input type="text" name="phone" value="{{ $participant->phone }}"><br>
    <button type="submit">Modifier</button>
</form>
