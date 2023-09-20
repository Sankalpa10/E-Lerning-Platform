<?php
    include 'header.php';
?>
<!-- FlexSlider -->
<!--
				  <script defer src="js/jquery.flexslider.js"></script>
				  <script type="text/javascript">
					$(function(){
					});
					$(window).load(function(){
					  $('.flexslider').flexslider({
						animation: "slide",
						start: function(slider){
						  $('body').removeClass('loading');
						}
					  });
					});
				  </script>
-->
<!-- FlexSlider -->
<!--banner end here-->
<!--educate logos start here-->
<!DOCTYPE html>
<html lang="en">
<head>
	<style>
		.req{
			background-color: #0060D6;
			border: none;
			color: white;
			padding: 30px 70px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 32px;
			font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
			margin: 4px 2px;
			cursor: pointer;
			
		}
		.req {border-radius: 15px;}
		.req:hover{
			background-color: blue;
		}
	</style>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<br>
<center><!-- Button to Open the Modal -->
<button type="button" class="req"  data-bs-toggle="modal" data-bs-target="#myModal">
  Request for Registration
</button></center>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Request Form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
<div class="modal-body">
    <?php
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_request'])) {
        $all_ok = 1;
        $msg = "";

        $name = $_POST['name'];
        $num = $_POST['num'];
        $sel = $_POST['select'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $amount = $_POST['amount'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $all_ok = 0;
            $msg = "INVALID EMAIL.";
        }

        if (!(strlen($num) == 10)) {
            $all_ok = 0;
            $msg = "INVALID MOBILE NUMBER.";
        }

		if($_FILES["image"]["error"] == 4){
			echo
			"<script> alert('Image Does Not Exist'); </script>"
			;
		  }
		  else{
			$fileName = $_FILES["image"]["name"];
			$fileSize = $_FILES["image"]["size"];
			$tmpName = $_FILES["image"]["tmp_name"];
		
			$validImageExtension = ['jpg', 'jpeg', 'png'];
			$imageExtension = explode('.', $fileName);
			$imageExtension = strtolower(end($imageExtension));
			if ( !in_array($imageExtension, $validImageExtension) ){
			  echo
			  "
			  <script>
				alert('Invalid Image Extension');
			  </script>
			  ";
			}
			else if($fileSize > 1000000){
			  echo
			  "
			  <script>
				alert('Image Size Is Too Large');
			  </script>
			  ";
			}

        elseif ($all_ok == 1) {
			$newImageName = uniqid();
      		$newImageName .= '.' . $imageExtension;

      		move_uploaded_file($tmpName, 'img/' . $newImageName);
            $insert = "INSERT INTO request (name, phone, gender, email, password, amount,image) VALUES ('$name', '$num', '$sel', '$email', '$pass', '$amount','$newImageName')";
            if ($conn->query($insert) === true) {
                ?>
                <script>
                    alert("Thanks for your Request. We will accept your request soon.");
                    window.location.assign("index.php");
                </script>
                <?php
            } else {
                echo $conn->error;
                ?>
                <script>
                    alert("You have already submitted a request.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("<?php echo $msg; ?>");
            </script>
            <?php
        }
	}
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_login'])) {
        // Handle login form submission if needed
    }
    ?>

    <div class="login-form">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
            <input type="text" placeholder="Name: [A-Z]" name="name" autocomplete="off" required="yes" pattern="[A-Za-z\\s]*" />
            <input type="number" placeholder="10 digit mobile number" name="num" autocomplete="off" required="yes" />
            <div>
                <select name="select"> 
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <input type="email" placeholder="E-Mail" name="email" autocomplete="off" required="yes" />
            <input type="password" placeholder="Password" name="pass" autocomplete="off" required="yes" />
            <input type="number" placeholder="Amount" name="amount" autocomplete="off" required="yes" />
  			<input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value="">
  
         
            
            <!-- Move the closing </form> tag here -->
            <div class="modal-footer">
                <button type="submit" name="submit_request" class="btn btn-primary">Request</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<!-- ... remaining code ... -->

      </div>
  </div>
</div>

<div class="educate">
	<div class="container">
		<div class="education-main">
			<ul class="ch-grid">
				 <div class="col-md-3 w3agile">
					<li>
						<div class="ch-item">
							<div class="ch-info">
								<div class="ch-info-front ch-img-1">
									<span class="glyphicon glyphicon-grain" aria-hidden="true"> </span>
					                <h5>Technology Stream</h5>
								</div>
								<div class="ch-info-back">
									<h3>TECH</h3>
									<p>GCE A/L</p>
								</div>
							</div>
						</div>
					</li>
					</div>
					 <div class="col-md-3 w3agile">
					<li>
						<div class="ch-item">
							<div class="ch-info">
								<div class="ch-info-front ch-img-2">
									<span class="glyphicon glyphicon-education" aria-hidden="true"> </span>
					                <h5>Science Streamn</h5>
								</div>
								<div class="ch-info-back">
									<h3>Science</h3>
									<p>GCE A/L</p>
								</div>
							</div>
						</div>
					</li>
					</div>
					 <div class="col-md-3 w3agile">
					<li>
						<div class="ch-item">
							<div class="ch-info">
								<div class="ch-info-front ch-img-3">
									<span class="glyphicon glyphicon-hourglass" aria-hidden="true"> </span>
					                <h5>Commerce Stream</h5>
								</div>
								<div class="ch-info-back">
									<h3>Commerce</h3>
									<p>GCE A/L</p>
								</div>
							</div>
						</div>
					</li>
					</div>
					 <div class="col-md-3 w3agile">
					<li>
						<div class="ch-item">
							<div class="ch-info">
								<div class="ch-info-front ch-img-4">
									<span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </span>
					                <h5>Art Stream</h5>
								</div>
								<div class="ch-info-back">
									<h3>Art</h3>
									<p>GCE A/L</p>
								</div>
							</div>
						</div>
					</li>
					</div>
					<div class="clearfix"> </div>
			 </ul>
		 </div>
	</div>
</div>
<!--educate logos end here-->
<!--we do start here-->
<!-- <div> 
<a href="register.php">Register In Here</a>
</div> -->
<div class="we-do">
	<div class="container">
		<div class="we-do-main">
			   <h2>What We Do </h2>
			   <h4>Conducting rivition video sessions</h4>
			   <p> This E-learning portal provides students good, easily understandable experience while learning online.Students can self understand 
            and learn,website aims to provide a personalized learning experience, mainly built on the videos which are hosted on YouTube. . </p>
			   <a href="about.php">Read More</a>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<!--we do end here-->
<!--pop-up-box-->
	  <script type="text/javascript" src="js/modernizr.custom.53451.js"></script>
	<link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
	<script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
<!--pop-up-box-->

<!--watch start here-->
<!--
<div class="watch-video">
	<div class="container">
		<div class="watch-video-main">
			<div class="video-bottom">
			 <a href="pricing.php"> <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"> </span> </a>
			 video
				<div id="small-dialog5" class="mfp-hide">
					<iframe src="https://player.vimeo.com/video/2990650" width="640" height="361" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen> </iframe>
				</div>
				 <script>
						$(document).ready(function() {
						$('.popup-with-zoom-anim').magnificPopup({
							type: 'inline',
							fixedContentPos: false,
							fixedBgPos: true,
							overflowY: 'auto',
							closeBtnInside: true,
							preloader: false,
							midClick: true,
							removalDelay: 300,
							mainClass: 'my-mfp-zoom-in'
						});

						});
				</script>
		</div>


			<h3>Watch Our Video</h3>
		</div>
	</div>
</div>
-->
<!--watch end here-->
<script src="js/responsiveslides.min.js"></script>
<script>
    // You can also use "$(window).load(function() {"
    $(function () {
      $("#slider2").responsiveSlides({
        auto: true,
        pager: true,
        speed: 300,
        namespace: "callbacks",
      });
    });
  </script>

<!--clients star here-->
<div class="we-do">
	<div class="container">
		<div class="we-do-main">
			   <h2 style="margin-top: 20px;">How It Works</h2>
         <h4>Value added services:</h4>
			   <p>It has always been said that online tutorials can never compete with actual teaching. Howsoever, today it has become a way of easy learning. To fill up the gap between Online and Personal tutorials.Here we provide best video tutorial to enhance your learning</p>
			   <h4>Personal Interaction sessions :</h4>
			   <p>Other than online tutorial sessions, you can personally contact us for clarification of doubts. For contact details, visit contact me tab.</p>
			   <h4>Media based clarification of doubts :</h4>
			   <p>You can Mail us during 20:00hrs to 21:00hrs where we would listen to your doubts and for further explanation, send you requisited media within 24hrs with  possible answer.</p>
         
      <div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="clients">
	<div class="container">
		<div class="clients-main">
			<div class="clients-top">
				<h3>Happy Students</h3>
			</div>
		 <div class="slider-bann wow bounceInRight" data-wow-delay="0.3s">
	    <ul class="rslides" id="slider2">
	      <li>
	      	<div class="clients-text">
	      		<p>I want to express my gratitude for the tuition class that played a crucial role in my academic journey. Without a doubt, it was a pivotal factor in my successful admission to the university. The dedicated instructors, comprehensive study materials, and personalized attention significantly contributed to my growth and development as a student. I am thankful for the support and guidance I received, and I highly recommend this tuition class to any student aiming for university admission.</p>
		        <p><i>-Taniya Anjali</i></p><br>
				<p>I owe a huge thank you to the tuition class for helping me secure my university admission this year. The exceptional teaching, rigorous curriculum, and constant support from the instructors were instrumental in my success. The class prepared me thoroughly, both academically and mentally, for the challenges of university life. I am immensely grateful for the invaluable learning experience provided by this tuition class.</p>
	            <p><i>-Kethaka Janadithya</i></p>
			</div>
	      </li>
<!--
	      <li>
	      	<div class="clients-text">
	      		<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>
		        <h4>Smith</h4>
	        </div>
	        </li>
	      <li>
	      	<div class="clients-text">
	      		<p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.</p>
		        <h4>Daneal</h4>
		  </div>
	      </li>
-->
	    </ul>
	    </div>
    </div>

	</div>
</div>
<!--clients end here-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
    include 'footer.php';
?>
