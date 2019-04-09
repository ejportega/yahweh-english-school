<?php
  session_start();
  include_once("header.php");
  include_once("navbar.php");
?>
<!-- DISPLAY UPLOAD IMAGE -->
<script type="text/javascript">
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#displayImage').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#imgUpload").change(function () {
    readURL(this);
  });
</script>
<style>
  small {
    font-size: 14px !important;
  }
</style>

<body class="fixed-nav sticky-footer" id="page-top">
  <div class="content-wrapper">
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          Application Form
        </div>
        <!-- /.panel-header -->
        <div class="panel-body">
          <div class="row justify-content-center">
            <div class="col-lg-6">
              <form id="form" action="application-insert.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                  <!-- Image chooser -->
                  <div class="form-group mx-auto" style="width:300px;">
                    <div>
                      <img src="../images/default-profile-image.png" id="image-chosen" class=" profile-img rounded-circle mx-auto d-block" alt="choose an image">
                    </div>
                    <div class="text-center my-2">
                      <label class="text-left custom-file">
                        <input id="image-chooser" type="file" class="custom-file-input" name="image" accept="image/*" required>
                        <span class="custom-file-control form-control-sm"></span>
                      </label>
                      <!-- Display iamge -->
                      <script>
                        function readURL(input) {
                          if (input.files && input.files[0]) {
                            var reader = new FileReader();

                            reader.onload = function (e) {
                              $('#image-chosen').attr('src', e.target.result);
                            }

                            reader.readAsDataURL(input.files[0]);
                          }
                        }
                        $("#image-chooser").change(function () {
                          readURL(this);
                        });
                      </script>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="font-weight-bold">Educational Attainment</label>
                    <select id="education" class="form-control" name="education" required>
                      <option value="" hidden selected disable>Select</option>
                      <option value="Some High School">High School Degree</option>
                      <option value="College Degree">College Degree</option>
                      <option value="Master Degree">Master Degree</option>
                      <option value="PhD Degree">PhD Degree</option>
                      <option value="Others">Others</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label class="font-weight-bold">Teaching Experience</label>
                    <select id="experience" class="form-control" name="experience" required>
                      <option value="" hidden  selected disable>Select</option>
                      <option value="none">none</option>
                      <option value="0~1 year">0~1 year</option>
                      <option value="1~2 years">1~2 years</option>
                      <option value="more than 2 years">more than 2 years</option>
                    </select>
                  </div>
                  <!-- Specialization -->
                  <div class="form-row">
                    <div class="col-md-12">
                      <label class="font-weight-bold">Specialization</label>
                      <div id="specialization-error" class="text-danger"></div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="English from Children ages 3-6"> English from Children ages 3-6
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Elementary English"> Elementary English
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Pre-intermediate to High Intermediate English"> Pre-intermediate to High Intermediate English
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Pre-Advanced"> Pre-Advanced
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Advanced"> Advanced
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Free flowing conversation"> Free flowing conversation
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Travel English"> Travel English
                        </label>
                      </div>
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" name="specialization[]" value="Business English"> Business English
                        </label>
                      </div>
                    </div>
                  </div>
                  <!-- How did you know about us -->
                  <!-- <div class="form-group">
                    <label class="font-weight-bold">How did you know about us?</label>
                    <select id="education" class="form-control" name="searched" required>
                      <option value="" hidden selected disable>Select</option>
                      <option value="Google">Google</option>
                      <option value="Facebook">Facebook</option>
                      <option value="Twitter">Twitter</option>
                      <option value="Instagram">Instagram</option>
                      <option value="Others">Others</option>
                    </select>
                  </div> -->
                  <!-- Self-introduction -->
                  <div class="form-group">
                    <label class="font-weight-bold">Self introduction</label>
                    <textarea class="form-control" rows="5" name="selfIntroduction" placeholder="Enter about yourself" required></textarea>
                  </div>
                  <!-- Others -->
                  <div class="form-group">
                    <label class="font-weight-bold">Others</label>
                    <ul class="p-0 ml-4">
                      <li>Send a short teaching demo video which runs a maximum of 2.5 minutes and send to
                        <a class="" href="">yahwehEnglishschool@yahoo.com</a> or
                        <a href="">yahwehEnglishschool@gmail.com</a>.</li>
                      <li>Wait for our notification through a mail/text for your initial first interview.</li>
                      <li>Send a resume to
                        <a class="" href="">yahwehEnglishschool@yahoo.com</a> or
                        <a href="">yahwehEnglishschool@gmail.com</a>.</li>
                    </ul>
                  </div>
                  <div class="form-group text-center">
                    <input class="btn btn-lg btn-outline-success btn-block" type="submit" name="submit" value="Save">
                  </div>
                </fieldset>
              </form>
            </div>
            <!-- /.col-lg-6(2ND COL) -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
    </div>
    <!-- /.container-fluid-->
    <?php include_once("footer.php") ?>
  </div>
  <!-- /.content-wrapper-->
  <?php include_once("js.php") ?>
  <!-- Modal -->
	<div id="modal-done" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Application Form Complete</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<!-- <span aria-hidden="true">&times;</span> -->
					</button>
				</div>
				<div class="modal-body">
					<p class="card-text">You may proceed to your schedule availability.</p>
				</div>
				<div class="modal-footer">
						<a class="btn btn-primary" href="application-details.php">Done</a>
				</div>
			</div>
		</div>
  </div>
  <!-- JS  -->
  <script type="text/javascript">
    $(document).ready(function() {
      $('#form').submit(function(e) {
        var form = $(this)[0];
        var data = new FormData(form);
        data.append("submit", $('#submit').val());
        $.ajax({
          url: 'application-insert.php',
          type: 'post',
          enctype: 'multipart/form-data',
          dataType: 'json',
          data: data,
          processData: false,
          contentType: false,
          cache: false,
          success: function(response) {
            if (response.c == 1) {
              displayError(response.c, response.e);
            }
            else if (response.c == 2) {
              $('#modal-done').modal('show');
            }
          }
        });
        e.preventDefault();
      });
    }); 

    function displayError(c, error) {
      if (c== 1) {
        $('#specialization-error').text(error).show();
			  $('html, body').animate({
				scrollTop: ($('#experience').offset().top)
			  },1000);
      }
    }
  </script>
</body>