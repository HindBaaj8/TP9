<h1>Créer un participant</h1>

<form action="/participants" method="POST">
    @csrf
    <label>First Name:</label>
    <input type="text" name="first_name"><br>
    <label>Last Name:</label>
    <input type="text" name="last_name"><br>
    <label>Email:</label>
    <input type="email" name="email"><br>
    <label>Phone:</label>
    <input type="text" name="phone"><br>
    <button type="submit">Créer</button>
</form>
