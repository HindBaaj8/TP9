<h1>Créer un speaker</h1>

<form action="/speakers" method="POST">
    @csrf
    <label>Name:</label>
    <input type="text" name="name"><br>
    <label>Bio:</label>
    <textarea name="bio"></textarea><br>
    <label>Email:</label>
    <input type="email" name="email"><br>
    <button type="submit">Créer</button>
</form>
