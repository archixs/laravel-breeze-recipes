<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($recipes as $recipe)
        <h2>{{$recipe->name}}</h2>
        <p>{{$recipe->description}}</p>
        <img src="{{Storage::url($recipe->image_path)}}" style="width: 200px; height: auto;">

        <form action="/recipe/{{$recipe->id}}/edit" method="post">
            @csrf
            <button>Edit</button>
        </form>
        <form action="/recipe/{{$recipe->id}}" method="post">
            @csrf
            @method('DELETE')
            <button>Delete</button>
        </form>
    @endforeach

    <form action="/recipe/create" method="get">
        <button>Make recipe</button>
    </form>
</body>
</html>