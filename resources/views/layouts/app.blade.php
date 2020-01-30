<!DOCTYPE html>
<html lang="en">
    <title>@yield('title', 'Learning')</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {font-family: "Lato", sans-serif}
        .mySlides {display: none}
    </style>
    <body>
        @section('navbar')
        @show

        @section('content')
        @show

        @section('footer')
        @show

        <script>
            // Automatic Slideshow - change image every 4 seconds
            var myIndex = 0;
            carousel();

            function carousel()
            {
                var i;
                var x = document.getElementsByClassName("mySlides");

                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";  
                }

                myIndex++;

                if (myIndex > x.length) {myIndex = 1}  

                x[myIndex-1].style.display = "block";  
                setTimeout(carousel, 4000);    
            }

            // Used to toggle the menu on small screens when clicking on the menu button
            function myFunction() 
            {
                var x = document.getElementById("navDemo");

                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";

                } else { 
                    x.className = x.className.replace(" w3-show", "");
                }
            }

            // When the user clicks anywhere outside of the modal, close it
            var modal = document.getElementById('ticketModal');

            window.onclick = function(event) {

                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </body>
</html>