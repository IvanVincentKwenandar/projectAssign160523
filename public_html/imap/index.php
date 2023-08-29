<?php 
  require 'connect.php';
  // header("Location:http://wgg.petra.ac.id/Coming_Soon/");
  if (isset($_GET['stat'])) {
    if ($_GET['stat'] == 1) {
      echo "<script>alert('NRP dan password salah! Silahkan coba lagi.');</script>";
    }
    else if ($_GET['stat'] == 2) {
      echo "<script>alert('Silahkan cek kembali captcha anda.');</script>"; 
    }
  }
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="WGG">
    <meta name="author" content="ITWGG2019">
    <!-- <link rel="shortcut icon" type="image/png" href="http://wgg.petra.ac.id/openrec_1/images/wgg.PNG"> -->

    <title>Panitia WGG 2019</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


<style type="text/css">
      <?php
        $hour = date("H");
        $timezone;
      if($hour < 4){
        $timezone = 3;
      }
      else if($hour < 7){
        $timezone = 2; 
      }
      else if($hour < 14){
        $timezone = 1;
      }
      else if($hour < 18){
        $timezone = 2;
      }
      else{
       $timezone = 3; 
      }
//       echo '
//         @media screen and (min-width: 1021px){
//         .site-wrapper{
//           background: url("http://wgg.petra.ac.id/panitia/assets/background/1920x1080/1920x1080-0'.$timezone.'.jpg");
//       background-position: center;
//       background-size: cover;
//       background-attachment: fixed; 
//           color:white;
//         }
//       }
//       @media screen and (max-width: 1020px){
//         .site-wrapper{
//           background: url("http://wgg.petra.ac.id/panitia/assets/background/1020x1366/1020x1366-0'.$timezone.'.jpg");
//     background-position: center;
//     background-size: cover;
//     background-attachment: fixed; 
//           color:white;
//         }
//       }
//       @media screen and(max-width: 360px){
//         .site-wrapper{
//           background: url("http://wgg.petra.ac.id/panitia/assets/background/360x640/360x640-0'.$timezone.'.jpg");
//     background-position: center;
//     background-size: cover;
//     background-attachment: fixed;
//           color:white;
//         }
//       }
//       ';
      ?>
      .pixie_con{
        overflow:hidden;
      }
      #pixie{
        z-index: 0;
    position: absolute;
    top: 0;
    left: 0;
      }
  </style>
  <script>

    var WIDTH;
var HEIGHT;
var canvas;
var con;
var g;
var pxs = new Array();
var rint = 50;

$(document).ready(function(){
  $("#pixie").css("z-index", "0");
  WIDTH = window.innerWidth;
  HEIGHT = window.innerHeight;
  $('#container').width(WIDTH).height(HEIGHT);
  canvas = document.getElementById('pixie');
  $(canvas).attr('width', WIDTH).attr('height',HEIGHT);
  con = canvas.getContext('2d');
  for(var i = 0; i < 50; i++) {
    pxs[i] = new Circle();
    pxs[i].reset();
  }
  setInterval(draw,rint);
  setInterval(draw,rint2);

});

function draw() {
  con.clearRect(0,0,WIDTH,HEIGHT);
  for(var i = 0; i < pxs.length; i++) {
    pxs[i].fade();
    pxs[i].move();
    pxs[i].draw();
  }
}

function Circle() {
  this.s = {ttl:8000, xmax:5, ymax:2, rmax:10, rt:1, xdef:960, ydef:540, xdrift:4, ydrift: 4, random:true, blink:true};

  this.reset = function() {
    this.x = (this.s.random ? WIDTH*Math.random() : this.s.xdef);
    this.y = (this.s.random ? HEIGHT*Math.random() : this.s.ydef);
    this.r = ((this.s.rmax-1)*Math.random()) + 1;
    this.dx = (Math.random()*this.s.xmax) * (Math.random() < .5 ? -1 : 1);
    this.dy = (Math.random()*this.s.ymax) * (Math.random() < .5 ? -1 : 1);
    this.hl = (this.s.ttl/rint)*(this.r/this.s.rmax);
    this.rt = Math.random()*this.hl;
    this.s.rt = Math.random()+1;
    this.stop = Math.random()*.2+.4;
    this.s.xdrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
    this.s.ydrift *= Math.random() * (Math.random() < .5 ? -1 : 1);
  }

  this.fade = function() {
    this.rt += this.s.rt;
  }

  this.draw = function() {
    if(this.s.blink && (this.rt <= 0 || this.rt >= this.hl)) this.s.rt = this.s.rt*-1;
    else if(this.rt >= this.hl) this.reset();
    var newo = 1-(this.rt/this.hl);
    con.beginPath();
    con.arc(this.x,this.y,this.r,0,Math.PI*2,true);
    con.closePath();
    var cr = this.r*newo;
    g = con.createRadialGradient(this.x,this.y,0,this.x,this.y,(cr <= 0 ? 1 : cr));
    g.addColorStop(0.0, 'rgba(238,180,28,'+newo+')');
    g.addColorStop(this.stop, 'rgba(238,180,28,'+(newo*.2)+')');
    g.addColorStop(1.0, 'rgba(238,180,28,0)');
    con.fillStyle = g;
    con.fill();
  }

  this.move = function() {
    this.x += (this.rt/this.hl)*this.dx;
    this.y += (this.rt/this.hl)*this.dy;
    if(this.x > WIDTH || this.x < 0) this.dx *= -1;
    if(this.y > HEIGHT || this.y < 0) this.dy *= -1;
  }

  this.getX = function() { return this.x; }
  this.getY = function() { return this.y; }
}
  </script>
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/cover.css" rel="stylesheet">
    
  </head>

  <body style="background-color: black;">

    <div class="site-wrapper">

      <div class="site-wrapper-inner pixie_con">
        <?php 
        if($timezone == 3){
          echo '<canvas id="pixie"></canvas>';
        } 
        ?>
          
        <div class="cover-container">
          
          <div class="masthead clearfix">
            <div class="inner row">
              <div class="col-sm-12 col-md-12 justify-content-center"><center><h2 style="font-weight: bold; color: white;"><center>Panitia WGG 2019</center></h2></center></div>
            </div>
          </div>

          <div class="inner cover" style="padding-top: 2%;">
            <form action="signin.php" method="POST" style="padding-top: 8%;">
            	<div class="row">
		            <div class="col-sm-12 col-md-6">
			            <div class="form-group">
      						    <label for="nrp" style="color:white;">NRP</label>
      						    <input type="text" class="form-control" id="nrp" name="nrp" aria-describedby="nrpHelp" placeholder="Enter NRP" required>
      						    <small id="nrpHelp" class="form-text" style="color: white;">Ex: m26416027 or a11170001</small>
      						</div>
      					</div>
      					<div class="col-sm-12 col-md-6">
      			      <div class="form-group">
      						    <label for="password" style="color: white;">Password</label>
      						    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password SIM" required>
      						</div>
      					</div>
      				</div>
  			      <div class="row justify-content-center">
                <button type="submit" class="btn btn-secondary" style="z-index: 1">Sign In</button>
              </div>
	            <br/>
	            <!-- ON THE SPOT INTERVIEW -->
            </form>

          </div>


        </div>
        <p style="color:white;">By IT Division WGG 2019</p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    <script type="text/javascript">
      var date = new Date($.now());
      var hour = date.getHours();
      
    </script>
  </body>
</html>
