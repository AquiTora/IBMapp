@auth
<form action="/import" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv">
    <button type="submit">Import CSV</button>
</form>
@else
    <a href="/">Страница для сотрудников</a>
@endauth