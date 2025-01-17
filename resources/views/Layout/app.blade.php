<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="text-fuchsia-950">
   @include('Layout.header')
  
  @yield('content')
  
  <!-- <footer class="text-xl font-bold text-center text-purple-500 uppercase py-6 bg-fuchsia-50 ">
   RAK
 </footer>
  -->
</body>
</html>