<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#317EFB" />
    
    <link rel="icon" type="image/svg+xml" href="/assets/favicon.f8e3f738.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JH Calendar</title>
    <link rel="stylesheet" href="/assets/index.login.css">
  </head>

    <style>
        .grid_container
        {
            display: grid;
            position: absolute;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(3, 1fr);
            grid-gap: 10vh;
            height: 100vh;
            width: 100vw;
        }
        /* display image centered vertically and horizontally */
        .grid_item
        {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

  <body>
    <!-- container to hold grid of background images -->
    <div class="grid_container">
        <div class="grid_item"><img src="/assets/img_01.jpg" alt="img01"/></div>
        <div class="grid_item">

            <section class="flex justify-center items-center h-full w-full text-lg">
                <form method="POST" action="/login" class="flex flex-col relative mx-0 my-auto p-5 text-base">
                    <input type="text" placeholder="User" name="name" class="p-2 bg-yellow-50 text-orange-500 mb-4 rounded-md outline-none transition-shadow shadow-sm hover:shadow-md focus:shadow-md text-base">
                    <input type="password" placeholder="Password" autocomplete="on" name="password" class="p-2 bg-yellow-50 text-orange-500 mb-4 rounded-md outline-none transition-shadow shadow-sm hover:shadow-md focus:shadow-md text-base">
                    <button id="loggin" type="submit" value="Login" class="p-4 text-yellow-50 uppercase bg-orange-500 border-none rounded-md outline-none cursor-pointer mt-3 shadow-md transition-colors hover:bg-orange-600 text-base">JH Diary</button>
                    @csrf
                </form>
            </section>
            
        </div>
        <div class="grid_item"><img src="/assets/img_03.jpg" alt="img03"/></div>
        <div class="grid_item"><img src="/assets/img_04.jpg" alt="img04"/></div>
        <div class="grid_item"><img src="/assets/img_05.jpg" alt="img05"/></div>
        <div class="grid_item"><img src="/assets/img_06.jpg" alt="img06"/></div>
    </div>
    

  </body>
</html>
