<?php include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	include 'connect.php';
	if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
		# code...
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$msg = $_POST['message'];

		$sql = "insert into contact(name,email,subject,msg) values('$name','$email','$subject','$msg')";
		if ($conn->query($sql) === true) {
			# code...
			$sub = "Contact from Website - EcoMyWay";
			$body = "name: $name\nEmail: $email\nSubject: $subject\nMessage: $msg";
			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= "From: $name <$email>" . "\r\n";

			$header = "From: arpit73891@gmail.com"."\r\n"."Reply-To: $email";
			mail('arpit73891@gmail.com',$sub,$body,$header);
			?>
			<script>
				alert("Thank You! quickly we will connect with you.");
			</script>
			<?php
		}else {
			?>
			<script>
				alert("Sorry! there was some server error. please try again.");
			</script>
			<?php
		}
	}
}

?>

<!--contact start here-->
<div class="contact">
	<div class="container">
		<div class="contact-main">
			<div class="contact-top">
				<h2>Contact</h2>
				<p>Please send us your suggestions and troubles of our online platform.</p>
			</div>
			<div class="contact-block1">
			 	<div class="col-md-6 contact-address">
			 	<h3>Contact Info</h3>
			 	<p>You can contact our Addimin using below methods.</p><br>
			 	<ul>
			    	<li><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span><p><a href="https://g.co/kgs/oe2ZAU">Administrator Of MASTER</a></p></li>
			    	<li><span class="glyphicon glyphicon-phone" aria-hidden="true"> </span><p><a href="https://chat.whatsapp.com/Ix3XKD20O0hIEY0FWeFzos ">0704174988</a></p></li>
			    	<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span><p><a href="mailto:masterhigheredu@gmail.com">masterhigheredu@gmail.com</a></p></li>
			    </ul>
			 	</div>
			 	<div class="col-md-6 contact-block-left">
				 	<form action="#" method="post">
				 		<input type="text" placeholder="Name" required="" name="name">
	                    <input type="text" class="email" placeholder="Email" name="email">
	                    <input type="text" class="subject" placeholder="Subject" name="subject">
	                    <textarea placeholder="Message" name="message"></textarea>
	                    <input type="submit" value="Send">
				 	</form>
			 	</div>
			 	<div class="clearfix"> </div>
			 </div>

		</div>
	</div>
</div>
<!--contact end here-->

<?php include 'footer.php'; ?>
