<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="theme-color" content="#317EFB" />
    
    <link rel="icon" type="image/svg+xml" href="/assets/favicon.f8e3f738.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>JH Calendar</title>
    <link rel="stylesheet" href="/assets/index.a74a455b.css">
  </head>

  <body>
    <div id="root" class="select-none box-border font-roboto font-normal md:text-xl text-sm scale-100 bg-slate-50">
        <!-- TOP NAV -->
        <div class="sticky top-0 z-50 outline outline-white outline-4 overscroll-contain">
            <div class="bg-stone-900 font-normal sm:text-lg custombp:text-xs customtp:text-xs flex justify-between items-center print:hidden">
                <div class="sm:ml-28 ml-2 overflow-visible whitespace-nowrap portrait:mr-2 text-white">JH Diary | user:</div>
                <div class="overflow-hidden whitespace-nowrap text-ellipsis portrait:mr-2 text-white"> 2022-01-01</div>
                <div class="text-white hover:text-black border-[1px] hover:bg-slate-50 my-0.5 mr-4 border-slate-50 hover:border-transparent rounded-full px-4 bg-transparent transition-colors">Logout</div>
            </div>
        </div>

        <!-- BOARD -->
        <div class="flex flex-col">
            <div class="grid gap-1 mt-1 xl:components-calendar sm:ml-2 mx-0 bg-white print:w-full print:px-10">
                <!-- LOOP OF MONTHS -->
                <div class="relative flex flex-col justify-start bg-white shadow-[5px_5px_5px_rgb(148,163,184)] rounded-md z-Dayoff print:mt-10 print:shadow-none">

                    <div id="month_header" class="flex justify-center sticky sm:top-9 customtp:top-6 custombp:top-6 z-TopLayer print:static print:align-middle font-normal text-black px-[2ch] border-b-2 border-slate-400 bg-gradient-to-r from-slate-200 via-slate-50 to-slate-200 rounded-t-md">2022-01-01</div>

                </div>
                <!-- END LOOP OF MONTHS -->

            </div>
        <!-- END BOARD -->
        </div>

    </div>
  </body>
</html>
