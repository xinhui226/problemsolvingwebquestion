<?php

    session_start();

    // Only change code below this line

        // instruction: require all the files you need here.
        require "includes/class-database.php";
        require "includes/class-contact-form.php";

    // Only change code above this line

    if ( class_exists('ContactForm') )
        $contact_form = new ContactForm();

    if ( $_SERVER["REQUEST_METHOD"] === "POST" ) {
        // Only change code below this line

            // instruction: get the data from the form and pass it to the submit method
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];

            $form = new ContactForm($name,$email,$message);
            $output = $form->submit();

            // [bonus point] instruction: if the data is inserted into database, send email to admin email via SMTP API (postmark, mailgun, etc.)

           if($output['status']=='success')
              $form->sendMessage();

        // Only change code above this line
    }


?>
<!DOCTYPE html>
<html>
  <head>
    <title>Contact Us</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #f1f1f1;
      }
    </style>
  </head>
  <body>
    <div class="container mt-5 mb-2 mx-auto" style="max-width: 700px;">
      <div class="min-vh-100">

            <!-- contact form -->
            <div class="card">
                <div class="card-body">

                    <h5 class="text-center pb-2">Contact Us</h5>

                    <!-- Only change code below this line -->

                        <!-- Instruction: Put error message or success message here -->
                        <?php if(isset($output) && $output['status']=='success') :?>
                        <div class="alert alert-info"><?=$output['message'];?></div>
                        <?php elseif(isset($output)&&$output['status']=='fail') : ?>
                        <div class="alert alert-warning"><?=$output['message'];?></div>
                        <?php endif; ?>

                    <!-- Only change code above this line -->

                    <form
                        action="<?php echo $_SERVER["REQUEST_URI"]; ?>"
                        method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder="Enter your name"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea
                                class="form-control"
                                id="message"
                                name="message"
                                rows="3"
                                placeholder="Enter your message"
                                required
                            ></textarea>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Send
                            </button>
                        </div>
                    </form>

                </div>
            </div>

      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>