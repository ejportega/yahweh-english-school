<?php 
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

$("#imgUpload").change(function(){
    readURL(this);
});
</script>
<style>
    small {font-size: 14px !important; }
</style>
<body class="fixed-nav sticky-footer" id="page-top">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item"><a class="nav-link active" href="#form1" data-toggle="tab">Application Form</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#form2" data-toggle="tab">Profile</a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="#messages" data-toggle="tab">Messages</a>
                            </li> -->
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content py-3">
                            <!-- Information Sheet -->
                            <div class="tab-pane fade show active" id="form1">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Application Form    
                                            </div>
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-lg-6">
                                                        <form role="form" action=""  method="POST" enctype="multipart/form-data">
                                                            <fieldset>
                                                                <!-- Image chooser -->
                                                                <div class="row justify-content-center">
                                                                    <div class="form-group col-lg-6 text-center">
                                                                        <img id="image-chosen" class="mb-1 profile-img" src="../images/default-profile-image.png" alt="choose an image" >
                                                                        <small class="form-text text-muted">Choose a descent profile picture</small>
                                                                        <input class="ml-3"id="image-chooser" type="file" name="image" accept="image/*" required>
                                                                        <!-- <input type="button" class="button-exam" value="Browse..." onclick="document.getElementById('image-chooser').click();">  -->
                                                                    </div>
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
                                                                        $("#image-chooser").change(function(){
                                                                            readURL(this);
                                                                        });
                                                                    </script>
                                                                </div>            
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Educational Attainment</label>
                                                                    <select class="form-control" name="educationalAttainment" required>
                                                                        <option selected disabled></option>
                                                                        <option value="Some High School">High School Degree</option>
                                                                        <option value="College Degree">College Degree</option>
                                                                        <option value="Master Degree">Master Degree</option>
                                                                        <option value="PhD Degree">PhD Degree</option>
                                                                        <option value="Others">Others</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Teaching Experience</label>
                                                                    <select class="form-control" name="experience" required>
                                                                        <option selected disabled></option>
                                                                        <option value="none">none</option>
                                                                        <option value="0~1 year">0~1 year</option>
                                                                        <option value="1~2 years">1~2 years</option>
                                                                        <option value="more than 2 years">more than 2 years</option>
                                                                    </select>
                                                                </div>
                                                                <!-- Specialization -->
                                                                <div class="form-row">
                                                                    <div class="col-md-12">
                                                                        <label class="font-weight-bold">Specialization:</label>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="English from Children ages 3-6">
                                                                                English from Children ages 3-6
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Elementary English">
                                                                                Elementary English
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Pre-intermediate to High Intermediate English">
                                                                                Pre-intermediate to High Intermediate English
                                                                            </label>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Pre-Advanced">
                                                                                Pre-Advanced
                                                                            </label>
                                                                        </div>   
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Advanced">
                                                                                Advanced
                                                                            </label>
                                                                        </div> 
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Free flowing conversation">
                                                                                Free flowing conversation
                                                                            </label>
                                                                        </div>  
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Travel English">
                                                                                Travel English
                                                                            </label>
                                                                        </div> 
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input class="form-check-input" type="checkbox" name="specialization[]" value="Business English">
                                                                                Business English
                                                                            </label>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                <!-- How did you know about us -->
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">How did you know about us?</label>
                                                                    <select class="form-control" name="searched" required>
                                                                        <option selected disabled></option>
                                                                        <option value="Google">Google</option>
                                                                        <option value="Facebook">Facebook</option>
                                                                        <option value="Twitter">Twitter</option>
                                                                        <option value="Instagram">Instagram</option>
                                                                        <option value="Others">Others</option>
                                                                    </select>
                                                                </div>
                                                                <!-- Others -->
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Others</label>
                                                                    <ul class="p-0 ml-4">
                                                                        <li>Send a short teaching demo video which runs a maximum of 2.5 minutes and send to <a class="" href="">yahwehEnglishschool@yahoo.com</a> or <a href="">yahwehEnglishschool@gmail.com</a>.</li>
                                                                        <li>Wait for our notification through a mail/text for your initial first interview.</li>
                                                                        <li>Send a resume to <a class="" href="">yahwehEnglishschool@yahoo.com</a> or <a href="">yahwehEnglishschool@gmail.com</a>.</li>
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
                                    <!-- /.col-lg-12 -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.tab -->
                            <div class="tab-pane fade" id="form2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Personal Information
                                            </div>
                                            <div class="row m-0">
                                                <div class="col-lg-6 p-0">
                                                    <div class="panel-body">
                                                        <form action="">
                                                            <fieldset>
                                                                <div class="form-group">
                                                                    <label>First name</label>
                                                                    <input class="form-control" type="text" name="fname" placeholder="Enter your first name" autofocus required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>E-mail address</label>
                                                                    <input class="form-control" type="email" name="lname" placeholder="Enter your e-mail address" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Country of Residence</label>
                                                                    <select class="form-control" name="country" required>
                                                                        <option selected disabled>Select country</option>
                                                                        <option value="Afghanistan">Afghanistan</option>
                                                                        <option value="Albania">Albania</option>
                                                                        <option value="Algeria">Algeria</option>
                                                                        <option value="American Samoa">American Samoa</option>
                                                                        <option value="Andorra">Andorra</option>
                                                                        <option value="Angola">Angola</option>
                                                                        <option value="Anguilla">Anguilla</option>
                                                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                                        <option value="Argentina">Argentina</option>
                                                                        <option value="Armenia">Armenia</option>
                                                                        <option value="Aruba">Aruba</option>
                                                                        <option value="Australia">Australia</option>
                                                                        <option value="Austria">Austria</option>
                                                                        <option value="Azerbaijan">Azerbaijan</option>
                                                                        <option value="The Bahamas">Austria</option>
                                                                        <option value="Bahrain">Bahrain</option>
                                                                        <option value="Bangladesh">Bangladesh</option>
                                                                        <option value="Barbados">Barbados</option>
                                                                        <option value="Belarus">Belarus</option>
                                                                        <option value="Belgium">Belgium</option>
                                                                        <option value="Belize">Belize</option>
                                                                        <option value="Benin">Benin</option>
                                                                        <option value="Bermuda">Bermuda</option>
                                                                        <option value="Bhutan">Bhutan</option>
                                                                        <option value="Bolivia">Bolivia</option>
                                                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                                        <option value="Botswana">Botswana</option>
                                                                        <option value="Brazil">Brazil</option>
                                                                        <option value="Brunei">Brunei</option>
                                                                        <option value="Bulgaria">Bulgaria</option>
                                                                        <option value="Burkina Faso">Burkina Faso</option>
                                                                        <option value="Burundi">Burundi</option>
                                                                        <option value="Cambodia">Cambodia</option>
                                                                        <option value="Cameroon">Cameroon</option>
                                                                        <option value="Canada">Canada</option>
                                                                        <option value="Cape Verde">Cape Verde</option>
                                                                        <option value="Cayman Islands">Cayman Islands</option>
                                                                        <option value="Central African Republic">Central African Republic</option>
                                                                        <option value="Chad">Chad</option>
                                                                        <option value="Chile">Chile</option>
                                                                        <option value="People's Republic of China">Peoples's Republic of China</option>
                                                                        <option value="Republic of China">Republic of China</option>
                                                                        <option value="Christmas Island">Christmas Island</option>
                                                                        <option value="Cocos(Keeling) Islands">Cocos(Keeling) Islands</option>
                                                                        <option value="Colombia">Cambodia</option>
                                                                        <option value="Comoros">Comoros</option>
                                                                        <option value="Congo">Congo</option>
                                                                        <option value="Cook Islands">Cook Islands</option>
                                                                        <option value="Costa Rica">Costa Rica</option>
                                                                        <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                                                        <option value="Croatia">Croatia</option>
                                                                        <option value="Cuba">Cuba</option>
                                                                        <option value="Cyprus">Cyprus</option>
                                                                        <option value="Czech Republic">Czech Republic</option>
                                                                        <option value="Denmark">Denmark</option>
                                                                        <option value="Djibouti">Djibouti</option>
                                                                        <option value="Dominica">Dominica</option>
                                                                        <option value="Dominican Republic">Dominican Republic</option>
                                                                        <option value="Ecuador">Ecuador</option>
                                                                        <option value="Egypt">Egypt</option>
                                                                        <option value="El Salvador">El Salvador</option>
                                                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                                        <option value="Eritrea">Eritrea</option>
                                                                        <option value="Estonia">Estonia</option>
                                                                        <option value="Ethiopia">Ethiopia</option>
                                                                        <option value="Falkland Islands">Falkland Islands</option>
                                                                        <option value="Faroe Islands">Faroe Islands</option>
                                                                        <option value="Fiji">Fiji</option>
                                                                        <option value="Finland">Finland</option>
                                                                        <option value="France">France</option>
                                                                        <option value="French Polynesia">French Polynesia</option>
                                                                        <option value="Gabon">Gabon</option>
                                                                        <option value="The Gambia">The Gambia</option>
                                                                        <option value="Georgia">Georgia</option>
                                                                        <option value="Germany">Germany</option>
                                                                        <option value="Ghana">Ghana</option>
                                                                        <option value="Gibraltar">Gibraltar</option>
                                                                        <option value="Greece">Greece</option>
                                                                        <option value="Greenland">Greenland</option>
                                                                        <option value="Grenada">Grenada</option>
                                                                        <option value="Guadeloupe">Guadeloupe</option>
                                                                        <option value="Guam">Guam</option>
                                                                        <option value="Guatemala">Guatamela</option>
                                                                        <option value="Guernsey">Guernsey</option>
                                                                        <option value="Guinea">Guinea</option>
                                                                        <option value="Guinea - Bissau">Guinea - Bissau</option>
                                                                        <option value="Guyana">Guyana</option>
                                                                        <option value="Haiti">Haiti</option>
                                                                        <option value="Honduras">Honduras</option>
                                                                        <option value="Hong Kong">Hongkong</option>
                                                                        <option value="Hungary">Hungary</option>
                                                                        <option value="Iceland">Iceland</option>
                                                                        <option value="India">India</option>
                                                                        <option value="Indonesia">Indonesia</option>
                                                                        <option value="Iran">Iran</option>
                                                                        <option value="Iraq">Iraq</option>
                                                                        <option value="Ireland">Ireland</option>
                                                                        <option value="Israel">Israel</option>
                                                                        <option value="Italy">Italy</option>
                                                                        <option value="Jamaica">Jamaica</option>
                                                                        <option value="Japan">Japan</option>
                                                                        <option value="Jersey">Jersey</option>
                                                                        <option value="Jordan">Jordan</option>
                                                                        <option value="Kazakhstan">Kazakhstan</option>
                                                                        <option value="Kenya">Kenya</option>
                                                                        <option value="Kiribati">Kiribati</option>
                                                                        <option value="North Korea">North Korea</option>
                                                                        <option value="South Korea">South Korea</option>
                                                                        <option value="Kosovo">Kosovo</option>
                                                                        <option value="Kuwait">Kuwait</option>
                                                                        <option value="Kyrgyzstan">Kyrgystan</option>
                                                                        <option value="Laos">Laos</option>
                                                                        <option value="Latvia">Latvia</option>
                                                                        <option value="Lebanon">Lebanon</option>
                                                                        <option value="Lesotho">Lesotho</option>
                                                                        <option value="Liberia">Liberia</option>
                                                                        <option value="Libya">Libya</option>
                                                                        <option value="Liechtenstein">Liechtenstein</option>
                                                                        <option value="Lithuania">Lithuania</option>
                                                                        <option value="Luxembourg">Luxembourg</option>
                                                                        <option value="Macau">Macau</option>
                                                                        <option value="Macedonia">Macedonia</option>
                                                                        <option value="Madagascar">Madagascar</option>
                                                                        <option value="Malawi">Malawi</option>
                                                                        <option value="Malaysia">Malaysia</option>
                                                                        <option value="Maldives">Maldives</option>
                                                                        <option value="Mali">Mali</option>
                                                                        <option value="Malta">Malta</option>
                                                                        <option value="Marshall Islands">Marshall Islands</option>
                                                                        <option value="Martinique">Martinique</option>
                                                                        <option value="Mauritania">Mauritania</option>
                                                                        <option value="Mauritius">Mauritius</option>
                                                                        <option value="Mayotte">Mayotte</option>
                                                                        <option value="Mexico">Mexico</option>
                                                                        <option value="Micronesia">Micronesia</option>
                                                                        <option value="Moldova">Moldova</option>
                                                                        <option value="Monaco">Monaco</option>
                                                                        <option value="Mongolia">Mongolia</option>
                                                                        <option value="Montenegro">Montenegro</option>
                                                                        <option value="Montserrat">Montserrat</option>
                                                                        <option value="Morocco">Morocoo</option>
                                                                        <option value="Mozambique">Mozambique</option>
                                                                        <option value="Myanmar">Myanmar</option>
                                                                        <option value="Nagorno - Karabakh">Nagorno - Karabakh</option>
                                                                        <option value="Namibia">Namibia</option>
                                                                        <option value="Nauru">Nauru</option>
                                                                        <option value="Nepal">Nepal</option>
                                                                        <option value="Netherlands">Netherlands</option>
                                                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                                        <option value="New Caledonia">New Caledonia</option>
                                                                        <option value="New Zealand">New Zealand</option>
                                                                        <option value="Nicaragua">Nicaragua</option>
                                                                        <option value="Niger">Niger</option>
                                                                        <option value="Nigeria">Nigeria</option>
                                                                        <option value="Niue">Niue</option>
                                                                        <option value="Norfolk Island">Norfolk Island</option>
                                                                        <option value="Turkish Republic of Northern Cyprus">Turkish Republic of Northern Cyprus</option>
                                                                        <option value="Northern Mariana">Northern Mariana</option>
                                                                        <option value="Norway">Norway</option>
                                                                        <option value="Oman">Oman</option>
                                                                        <option value="Pakistan">Pakistan</option>
                                                                        <option value="Palau">Palau</option>
                                                                        <option value="Palestine">Palestine</option>
                                                                        <option value="Panama">Panama</option>
                                                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                                                        <option value="Paraguay">Paraguay</option>
                                                                        <option value="Peru">Peru</option>
                                                                        <option value="Philippines">Philippines</option>
                                                                        <option value="Pitcairn Islands">Pitcairn Islands</option>
                                                                        <option value="Poland">Poland</option>
                                                                        <option value="Portugal">Portugal</option>
                                                                        <option value="Puerto Rico">Puerto Rico</option>
                                                                        <option value="Qatar">Qatar</option>
                                                                        <option value="Romania">Romania</option>
                                                                        <option value="Russia">Russia</option>
                                                                        <option value="Rwanda">Rwanda</option>
                                                                        <option value="Saint Barthelemy">Saint Barthelemy</option>
                                                                        <option value="Saint Helena">Saint Helena</option>
                                                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                                        <option value="Saint Lucia">Saint Lucia</option>
                                                                        <option value="Saint Martin">Saint Martin</option>
                                                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                                        <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                                        <option value="Samoa">Samoa</option>
                                                                        <option value="San Marino">San Marino</option>
                                                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                                                        <option value="Senegal">Senegal</option>
                                                                        <option value="Serbia">Serbia</option>
                                                                        <option value="Seychelles">Seychelles</option>
                                                                        <option value="Sierra Leone">Sierra Leone</option>
                                                                        <option value="Singapore">Singapore</option>
                                                                        <option value="Slovakia">Slovakia</option>
                                                                        <option value="Slovenia">Slovenia</option>
                                                                        <option value="Solomon Islands">Solomon Islands</option>
                                                                        <option value="Somalia">Somalia</option>
                                                                        <option value="Somaliland">Somaliland</option>
                                                                        <option value="South Africa">South Africa</option>
                                                                        <option value="South Ossetia">South Ossetia</option>
                                                                        <option value="Spain">Spain</option>
                                                                        <option value="Sri Lanka">Sri Lanka</option>
                                                                        <option value="Sudan">Sudan</option>
                                                                        <option value="Suriname">Suriname</option>
                                                                        <option value="Svalbard">Svalbard</option>
                                                                        <option value="Swaziland">Swaziland</option>
                                                                        <option value="Sweden">Sweden</option>
                                                                        <option value="Switzerland">Switzerland</option>
                                                                        <option value="Syria">Syria</option>
                                                                        <option value="Taiwan">Taiwan</option>
                                                                        <option value="Tajikistan">Tajikistan</option>
                                                                        <option value="Tanzania">Tanzania</option>
                                                                        <option value="Thailand">Thailand</option>
                                                                        <option value="Timor - Leste">Timor - Leste</option>
                                                                        <option value="Togo">Togo</option>
                                                                        <option value="Tokelau">Tokelau</option>
                                                                        <option value="Tonga">Tonga</option>
                                                                        <option value="Transnistria Pridnestrovie">Transnistria Pridnestrovie</option>
                                                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                                        <option value="Tristan da Cunha">Tristan da Cunha</option>
                                                                        <option value="Tunisia">Tunisia</option>
                                                                        <option value="Turkey">Turkey</option>
                                                                        <option value="Turkmenistan">Turkmenistan</option>
                                                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                                        <option value="Tuvalu">Tuvalu</option>
                                                                        <option value="Uganda">Uganda</option>
                                                                        <option value="Ukraine">Ukraine</option>
                                                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                                                        <option value="United Kingdom">United Kingdom</option>
                                                                        <option value="United States">United States</option>
                                                                        <option value="Uruguay">Uruguay</option>
                                                                        <option value="Uzbekistan">Uzbekistan</option>
                                                                        <option value="Vanuatu">Vanuatu</option>
                                                                        <option value="Vatican City">Vatican City</option>
                                                                        <option value="Venezuela">Venezuela</option>
                                                                        <option value="Vietnam">Vietnam</option>
                                                                        <option value="British Virgin Islands">British Virgin Islands</option>
                                                                        <option value="Isle of Man">Isle of Man</option>
                                                                        <option value="US Virgin Islands">US Virgin Islands</option>
                                                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                                        <option value="Western Sahara">Western Sahara</option>
                                                                        <option value="Yemen">Yemen</option>
                                                                        <option value="Zambia">Zambia</option>
                                                                        <option value="Zimbabwe">Zimbabwe</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Password</label>
                                                                    <input class="form-control" type="password" name="password" placeholder="Enter your password" required>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- /.col-lg-6(1st col) -->
                                                <div class="col-lg-6 p-0 ">
                                                    <div class="panel-body">
                                                        <fieldset>
                                                            <div class="form-group">
                                                                <label>Last name</label>
                                                                <input class="form-control" type="text" name="lname" placeholder="Enter your last name" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Age</label>
                                                                <input class="form-control" type="number" min="4" max="60" placeholder="Enter your current age" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Skype</label>
                                                                <input class="form-control" type="text" name="skype" placeholder="Enter your skype account" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Confirm password</label>
                                                                <input class="form-control" type="password" name="confirmPassword" placeholder="Confirm your password" required>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <!-- /.panel-body -->
                                                </div>
                                                <!-- /.col-lg-6(2nd col) -->
                                                <div class="col-lg-12 mb-3">
                                                    <input class="btn btn-outline-success btn-lg btn-block" type="submit" name="submit" value="Save">
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab -->
                            <div class="tab-pane fade" id="messages">
                                <h4>Messages Tab</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <div class="tab-pane fade" id="settings">
                                <h4>Settings Tab</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid-->
        <?php include_once("footer.php") ?>
    </div>
    <!-- /.content-wrapper-->
    <!-- <?php include_once("js.php") ?> -->
</body>