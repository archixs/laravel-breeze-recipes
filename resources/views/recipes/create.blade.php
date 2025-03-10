<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/recipe" method="post" enctype="multipart/form-data">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name">

        <label for="description">Description</label>
        <input type="text" name="description" id="description">

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="latvian">Latvian</option>
            <option value="china">Chinese</option>
            <option value="america">American</option>
        </select>

        <label for="image">Image</label>
        <input type="file" name="image" id="image">

        <button>Save recipe</button>
    </form>

</body>
</html>