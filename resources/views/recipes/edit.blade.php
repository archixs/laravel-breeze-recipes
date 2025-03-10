<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="/recipe/{{$recipe->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{$recipe->name}}">

        <label for="description">Description</label>
        <input type="text" name="description" id="description" value="{{$recipe->description}}">

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="latvian" {{ $recipe->category == 'latvian' ? 'selected' : '' }}>Latvian</option>
            <option value="chinese" {{ $recipe->category == 'chinese' ? 'selected' : '' }}>Chinese</option>
            <option value="american" {{ $recipe->category == 'american' ? 'selected' : '' }}>American</option>
        </select>

        <label for="image">Image</label>
        <input type="file" name="image" id="image" value="{{$recipe->image_path}}">
        


        <img src="{{Storage::url($recipe->image_path)}}" style="width: 200px; height: auto;">

        <button>Save changes</button>
    </form>

</body>
</html>