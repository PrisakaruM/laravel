@extends('layouts.app')

@section('navbar')
    @parent
    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-black w3-card">
            <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
            <a href="#" class="w3-bar-item w3-button w3-padding-large">HOME</a>
            <a href="#band" class="w3-bar-item w3-button w3-padding-large w3-hide-small">BLOG</a>
            <a href="javascript:void(0)" class="w3-padding-large w3-hover-red w3-hide-small w3-right"><i class="fa fa-search"></i></a>
        </div>
    </div>

    <!-- Navbar on small screens (remove the onclick attribute if you want the navbar to always show on top of the content when clicking on the links) -->
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
        <a href="#band" class="w3-bar-item w3-button w3-padding-large" onclick="myFunction()">BLOG</a>
    </div>
@endsection

@section('content')
    @parent
    <!-- Page content -->
    <div class="w3-content" style="max-width:2000px;margin-top:46px">

        <!-- Automatic Slideshow Images -->
        <div class="mySlides w3-display-container w3-center">
            <img src="{{asset('img/slider/2.jpg')}}" style="width:100%">
            <div class="w3-display-bottommiddle w3-container w3-text-white w3-padding-32 w3-hide-small">
            <h3>BLOG</h3> 
            </div>
        </div>

        <!-- The Band Section -->
        @foreach ($data as $post)
            <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
                <h2 class="w3-wide"><a href="{{$app->make('url')->to('/post/' . $post['id_post'])}}">{{$post['title']}}</a></h2>
                <p class="w3-justify">{{$post['content']}}</p>
            </div>
        @endforeach
        

        <!-- The Tour Section -->
        <div class="w3-black" id="tour">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px">
            <h2 class="w3-wide w3-center">TESTING</h2>
            <p class="w3-opacity w3-center"><i>Description</i></p><br>

            <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                <div class="w3-third w3-margin-bottom">
                <img src="{{asset('img/prices/test.jpg')}}" alt="New York" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>New York</b></p>
                    <p class="w3-opacity">Fri 27 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                <img src="{{asset('img/prices/test.jpg')}}" alt="Paris" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>Paris</b></p>
                    <p class="w3-opacity">Sat 28 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                </div>
                </div>
                <div class="w3-third w3-margin-bottom">
                <img src="{{asset('img/prices/test.jpg')}}" alt="San Francisco" style="width:100%" class="w3-hover-opacity">
                <div class="w3-container w3-white">
                    <p><b>San Francisco</b></p>
                    <p class="w3-opacity">Sun 29 Nov 2016</p>
                    <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                    <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Ticket Modal -->
        <div id="ticketModal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
            <header class="w3-container w3-teal w3-center w3-padding-32"> 
                <span onclick="document.getElementById('ticketModal').style.display='none'" 
            class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
                <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tickets</h2>
            </header>
            <div class="w3-container">
                <p><label><i class="fa fa-shopping-cart"></i> Tickets, $15 per person</label></p>
                <input class="w3-input w3-border" type="text" placeholder="How many?">
                <p><label><i class="fa fa-user"></i> Send To</label></p>
                <input class="w3-input w3-border" type="text" placeholder="Enter email">
                <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">PAY <i class="fa fa-check"></i></button>
                <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
                <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
            </div>
            </div>
        </div>

        <!-- The Contact Section -->
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">CONTACT</h2>
            <p class="w3-opacity w3-center"><i>Fan? Drop a note!</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i> Chicago, US<br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: +00 151515<br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: mail@mail.com<br>
                </div>
                <div class="w3-col m6">
                    <form action="/action_page.php" target="_blank">
                    <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                        <div class="w3-half">
                        <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
                        </div>
                        <div class="w3-half">
                        <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
                        </div>
                    </div>
                    <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
                    <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>

    <!-- End Page Content -->
    </div>
@endsection

@section('footer')
    @parent
    <!-- Footer -->
    <footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
        <i class="fa fa-facebook-official w3-hover-opacity"></i>
        <i class="fa fa-instagram w3-hover-opacity"></i>
        <i class="fa fa-snapchat w3-hover-opacity"></i>
        <i class="fa fa-pinterest-p w3-hover-opacity"></i>
        <i class="fa fa-twitter w3-hover-opacity"></i>
        <i class="fa fa-linkedin w3-hover-opacity"></i>
        <p class="w3-medium">Powered by <a href="" target="_blank">Learning</a></p>
    </footer>
@endsection