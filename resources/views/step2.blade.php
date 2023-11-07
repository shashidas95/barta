<form method="post" action="/multi-step-form/step2">
    @csrf
    <input type="hidden" name="name" value="{{ old('name') }}">
    <input type="hidden" name="email" value="{{ old('email') }}">
    <!-- Additional fields for step 2 -->
    <input type="text" name="phone" placeholder="Phone">

    <button type="submit">Submit</button>
</form>
{{ session('name') }}
{{ session('email') }}
