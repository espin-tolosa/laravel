<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#317EFB" />
    
    <link rel="icon" type="image/svg+xml" href="/assets/favicon.f8e3f738.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JH Calendar</title>
    <link rel="stylesheet" href="/assets/index.90ed9c43.css">
  </head>

  <body>
    
    <section class="flex justify-center items-center h-full w-full text-lg">
        <form method="POST" action="/board" class="flex flex-col relative mx-0 my-auto p-5 text-base">
            <input type="text" placeholder="User" name="user" class="p-2 bg-yellow-50 text-orange-500 mb-4 rounded-md outline-none transition-shadow shadow-sm hover:shadow-md focus:shadow-md text-base">
            @csrf
            <input type="password" placeholder="Password" autocomplete="on" name="password" class="p-2 bg-yellow-50 text-orange-500 mb-4 rounded-md outline-none transition-shadow shadow-sm hover:shadow-md focus:shadow-md text-base">
            <button id="loggin" type="submit" value="Login" class="p-4 text-yellow-50 uppercase bg-orange-500 border-none rounded-md outline-none cursor-pointer mt-3 shadow-md transition-colors hover:bg-orange-600 text-base">JH Diary</button>
        </form>
    </section>


  </body>
</html>