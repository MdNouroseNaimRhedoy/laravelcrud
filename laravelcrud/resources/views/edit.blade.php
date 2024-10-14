<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <style type="text/tailwindcss">
        @layer utilities {
          .container{
            @apply px-10 mx-auto;
          }
        }
      </style>
    <title>Document</title>
</head>
<body>
    <div class="container">
       <div class="flex justify-between">
            <h1 class="text-red-500 text-xl font-bold underline">Edit Info.for {{$ourPost->name}}</h1>
        
            <a href="/" class="bg-green-600 text-white rounded by py-2 px-4">Back to home</a>
        </div> 

        <div>
            <form method="POST" action="{{route('update',$ourPost->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col gap-5">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{$ourPost->name}}">
                    @error('name')
                        <p class="text-red-600">{{$message}}</p>
                    @enderror

                    <label for="description">Description</label>
                    <input type="text" name="description" value="{{$ourPost->description}}">
                    @error('description')
                        <p class="text-red-600"> {{$message}} </p>
                    @enderror

                    <label for="image">Select Images</label>
                    <input type="file" name="image" id="">
                    @error('image')
                        <p class="text-red-600 bold"> {{$message}} </p>
                    @enderror

                    <div>
                        <input type="submit" class="bg-green-600 text-white rounded by py-2 px-4">
                    </div>
                    
                    
                </div>
            </form>
        </div>
    </div>
    
    
</body>
</html>