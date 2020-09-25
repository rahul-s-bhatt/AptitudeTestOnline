<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1 , user-scalable=no">                         

  <!-- Web Fonts -->        
  <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">

  <!-- Css Plugins for Fonts i.e. Google Fonts , Font Awesome!  -->
  <link rel="stylesheet" href="styles/font-awesome.min.css"/> 
  <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">                          

  <!-- Css Theme -->           
   <link rel="stylesheet" type="text/css" href="styles/style.css">
   <link rel="stylesheet" type="text/css" href="navbar.css">

   <!-- Js Script -->
   <link rel="stylesheet" type="text/js" href="js/script.js">
</head>
<body>
<footer class="site-footer">
      <div class="container">
        <div class="row">
          <div style="text-align: center;">
            <span>SOCIAL MEDIA LINKS</span>
            <ul class="social-icons">
              <li><a class="facebook" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
              <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li> 
            </ul>
          </div>
        </div>
        <!-- Trigger/Open The Modal -->
        <div style="text-align: center;"><img id="myBtn" src="favicon.png" style="width: 3em; height: 3em; cursor: pointer;"></div>

        <!-- The Modal -->
        <div id="myModal" class="modal">

          <!-- Modal content -->
          <div class="modal-content">
            <span style="color: blueviolet;">COMPANY HEADS</span> <br>
            <span class="close">&times;</span>
            <button class="click-me" onclick="loadDoc();">Click me!</button>
            <table id="demo" style="color: black;text-align: justify;"></table>
          </div>

        </div>
      </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">

        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }


        function loadDoc() {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            myFunction(this);
            }
          };
          xhttp.open("GET", "test.xml", true);
          xhttp.send();
        }
        function myFunction(xml) {
          var i;
          var xmlDoc = xml.responseXML;
          var table="<tr><th>NAME</th><th>POSITION</th></tr>";
          var x = xmlDoc.getElementsByTagName("PERSON");
          for (i = 0; i <x.length; i++) {
            table += "<tr><td>" +
            x[i].getElementsByTagName("NAME")[0].childNodes[0].nodeValue +
            "</td><td>" +
            x[i].getElementsByTagName("POSITION")[0].childNodes[0].nodeValue +
            "</td></tr>";
          }
          document.getElementById("demo").innerHTML = table;
          var x = document.getElementById("btn");
          x.style.display = "none";
        }


        </script>
        <style type="text/css">
          /* The Modal (background) */
        .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
          background-color: #fefefe;
          margin: auto;
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
        </style>
        <script src="https://use.fontawesome.com/48ea71726e.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjTIiHIj-g-fKHz96VvxXrD5usY4HWDCw&callback=initMap"></script>
        <script src="script.js"></script>  
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>