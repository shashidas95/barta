<form method="post" action="/multi-step-form">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <button type="submit">Next</button>
</form>
