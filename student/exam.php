<?php
    include_once("../includes/home/header.php");

    if (isset($_GET['level'])) {
        $level = $_GET['level'];
    }
    else {
        $level = 1;
    }
?>

<script type="text/javascript">
var pos = 0, test, score = 0, question, choice1, choice2, choice3, choice4, sunod, answer, type;
var level = <?php echo $level ?>;
var elementary = [
    ["1. Simon <u class='undeline-spaces'>_________________</u>  very tall.", "is", "are", "has", "A"],
    ["2. She <u class='undeline-spaces'>_________________</u>  like football very much.", "don't", "doesn't", "hasn't", "B"],
    ["3. How <u class='undeline-spaces'>_________________</u>  does one lesson cost?", "many", "much", "is", "B"],
    ["4. There <u class='undeline-spaces'>_________________</u>  a big supermarket next to my house.", "is", "are", "have", "A"],
    ["5. I <u class='undeline-spaces'>_________________</u>  agree with you.", "doesn't", "haven't", "don't", "C"],
    ["6. Magnus can't <u class='undeline-spaces'>_________________</u>  tennis. He's broken his arm.", "to play", "playing", "play", "C"],
    ["7. <u class='undeline-spaces'>_________________</u>  some more tea?", "Would you like", "Do you like", "You'd like", "B"]    
];
var intermediate = [
    ["1. Last week we <u class='undeline-spaces'>_________________</u>  to Warsaw.", "go", "went", "goes", "B"],
    ["2. I <u class='undeline-spaces'>_________________</u>  the film we saw at cinema on Wednesday.", "doesn't like", "haven't liked", "didn't like", "C"],
    ["3. Magda <u class='undeline-spaces'>_________________</u>  in England for her holiday last year", "was", "were", "is", "A"],
    ["4. My mother <u class='undeline-spaces'>_________________</u>  never been to a cricket match.", "hadn't", "haven't", "has", "C"],
    ["5. Joana <u class='undeline-spaces'>_________________</u>  her new mobile phone.", "is losing", "loses", "has lost", "B"],
    ["6. <u class='undeline-spaces'>_________________</u>  ever seen a comet?", "Did you", "Have you", "Do you", "B"],
    ["7. If I were rich, I <u class='undeline-spaces'>_________________</u>  buy a huge house in Someret.", "will", "shall", "would", "C"],
    ["8. They <u class='undeline-spaces'>_________________</u>  pass their exam if they studied hard.", "would", "will", "did", "A"],
    ["9. I wish I <u class='undeline-spaces'>_________________</u>  play a musical instrument.", "can", "could", "should", "B"]
];
var upperIntermediate = [
    ["1. When Gregory arrived at the disco, Hanina <u class='undeline-spaces'>_________________</u> .", "already left", "has already left", "had already left", "C"],
    ["2. If I <u class='undeline-spaces'>_________________</u>  on holiday to Poland, I wouldn't have met Donata.", "didn't go", "haven't gone", "hadn't gone", "C"],
    ["3. By the time you get this letter I <u class='undeline-spaces'>_________________</u> .", "will have left", "am going to leave", "would leave", "A"],
    ["4. A: What are you doing tonight? B: I'm not usre, I <u class='undeline-spaces'>_________________</u>  to the cinema.", "will go", "would go", "might go", "C"],
    ["5. Simon forgot <u class='undeline-spaces'>_________________</u>  the lights before he left.", "turn off", "turning off", "to turn off", "C"],
    ["6. It's no use <u class='undeline-spaces'>_________________</u>  to him. He doesn't listen.", "to speak", "spoke", "speaking", "C"],
    ["7. Karla was offered the job <u class='undeline-spaces'>_________________</u>  having poor qualifications.", "despite", "although", "even though", "A"],
    ["8. The offer was too good for David to turn <u class='undeline-spaces'>_________________</u> .", "off", "down", "away", "B"],
    ["9. Eric's father ordered him <u class='undeline-spaces'>_________________</u>  out late again.", "not to stay", "not stay", "not staying", "A"],
    ["10. If only I <u class='undeline-spaces'>_________________</u>  to the barbecue instead of staying at home.", "went", "had gone", "did go", "B"]
];
var advanced = [
    ["1. Not only <u class='undeline-spaces'>_________________</u>  to London but she also visited many other places in England.", "she went", "went she", "did she go", "C"],
    ["2. My sister <u class='undeline-spaces'>_________________</u>  regretted turning down the chance of studying at the Teacher Training College in Gorzow.", "entirely", "bitterly", "absolutely", "B"],
    ["3. Now remember, you <u class='undeline-spaces'>_________________</u>  the test until the teacher tells you to.", "are not starting", "are not to start", "haven't started", "B"],
    ["4. She wasn't <u class='undeline-spaces'>_________________</u>  to reach the ceiling.", "tall enough", "so tall", "as tall", "A"],
    ["5. He was thought <u class='undeline-spaces'>_________________</u>  the disease in Pakistan.", "to catch", "catching", "to have caught", "C"],
    ["6. My flat <u class='undeline-spaces'>_________________</u>  as soon as possible. It's in an awful state.", "needs redecorating", "to redecorate", "redecorated", "A"],
    ["7. He eventually managed <u class='undeline-spaces'>_________________</u>  the door by kicking it hard.", "open", "opening", "to open", "C"],
    ["8. There's no point <u class='undeline-spaces'>_________________</u>  staying up all night if your exam is tomorrow.", "on", "with", "in", "C"],
    ["9. Rarely <u class='undeline-spaces'>_________________</u>  meat.", "I eat", "do I eat", "I have eaten", "B"]
];

function _(x) {
    return document.getElementById(x);
}

function renderQuestion() {
    item = _("item");
    test = _("test");
    choice1 = _("choice1");
    choice2 = _("choice2");
    choice3 = _("choice3");
    choice4 = _("choice4");
    sunod = _("sunod");
    
    item.innerHTML = (pos + 1) + " of " + getLevel().length;
    test.innerHTML = question;
    choice1.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='A'><span class='mx-2 font-weight-bold'>a.</span>" + chA; 
    choice2.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='B'><span class='mx-2 font-weight-bold'>b.</span>" + chB;
    choice3.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='C'><span class='mx-2 font-weight-bold'>c.</span>" + chC;

    if (pos < getLevel().length - 1) {
        sunod.innerHTML = "<button id='btn-next' class='btn btn-outline-success' onclick=next()>Next</button>"; 
        // console.log(pos + " " + getLevel().length);
    }
    else {
        // sunod.innerHTML = "<a href='#'><button class='button-exam' onclick=\"confirm('Are you done answering the test?')\">Done</button></a>"; 
        // sunod.innerHTML = "<a href='exam-result.php?score=" +score+ "'><button class='button-exam'>Done</button></a>";
        sunod.innerHTML = "<button class='btn btn-outline-success' onclick=next()>Done</button>";
    }
   
}


function getLevel() {
    switch(level) {
    case 1:
        question = elementary[pos][0];
        chA = elementary[pos][1];
        chB = elementary[pos][2];
        chC = elementary[pos][3];
        return elementary;
        break;
    case 2:
        question = intermediate[pos][0];
        chA = intermediate[pos][1];
        chB = intermediate[pos][2];
        chC = intermediate[pos][3];
        return intermediate;
        break;
    case 3:
        question = upperIntermediate[pos][0];
        chA = upperIntermediate[pos][1];
        chB = upperIntermediate[pos][2];
        chC = upperIntermediate[pos][3];
        return upperIntermediate;
        break;
    case 4:
        question = advanced[pos][0];
        chA = advanced[pos][1];
        chB = advanced[pos][2];
        chC = advanced[pos][3];
        return advanced;    
        break;
    }
}

function next() {

    switch(level) {

        case 1:
            answer = elementary[pos][4];
            break;
        case 2:
            answer = intermediate[pos][4];
            break;
        case 3:
            answer = upperIntermediate[pos][4];
            break;
        case 4:
            answer = advanced[pos][4];
            break;
    }

    choices = document.getElementsByName("choices");
    var isChecked = false;
    for (var i = 0 ; i < choices.length ; i++) {
        if (choices[i].checked) {
            choices = choices[i].value;
            isChecked = true;
        }
    }
    if (isChecked) {
        if (choices == answer) {
        score++;
        }
        if (pos < getLevel().length - 1) {
            pos++;
            var isChecked = choices.checked;
            renderQuestion();
        }          
        else {
            window.location.href =  "exam-result.php?score="+score+"&overall="+getLevel().length+"&level="+level;
            pos = 0;
        }
    }
    else {
        alert("Please choose the best answer");
    }  
}

window.addEventListener("load", renderQuestion, false);
</script>
<body>
<body>
<div id="wrapper">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg-8 col-lg-offset-2">
                <!-- Heading -->
                <div class="row mb-3 m-0" style="border-bottom:1px solid #e2e1e1;">
                    <div class="col-lg-6 p-0 text-left">
                        <strong>Item no:&nbsp;</strong><span id="item">5 of 11</span>
                    </div>
                    <!-- /.col-lg-6(1st col) -->
                    <div class="col-lg-6 p-0 text-right">
                        <strong>Time remaining:&nbsp;</strong><span id="timer"></span>
                        <script>
                            document.getElementById('timer').innerHTML = 08 + ":" + 01;
                            startTimer();

                            function startTimer() {
                            var presentTime = document.getElementById('timer').innerHTML;
                            var timeArray = presentTime.split(/[:]+/);
                            var m = timeArray[0];
                            var s = checkSecond((timeArray[1] - 1));
                            if(s==59){m=m-1}
                            if(m<0){
                                window.location.href =  "exam-result.php?score="+score+"&overall="+getLevel().length+"&level="+level;
                            }

                            document.getElementById('timer').innerHTML = m + ":" + s;
                            setTimeout(startTimer, 1000);
                            }

                            function checkSecond(sec) {
                            if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
                            if (sec < 0) {sec = "59"};
                            return sec;
                            }
                        </script>
                    </div>
                    <!-- /.col-lg-6(2nd col) -->
                </div>
                <!-- /.row(heading) -->
                <!-- Question -->
                <div class="panel-body">
                    <div class="col-lg-12 p-0 mb-3">
                        <strong>Question:</strong><br>  
                        <strong style="color:#283761" id="test"></strong> 
                    </div>   
                    <!-- /.col-lg-12 -->
                    <!-- Options -->
                    <div class="row">
                        <!-- Choice A -->
                        <div class="form-check col-lg-12">
                            <label class="form-check-label">
                                <div id="choice1"></div>
                                <!-- <input class="form-check-input" type="radio" name="choices" value="A">
                                <span class="font-weight-bold mx-1">&nbsp;a.&nbsp;</span><span id="choice1" ></span> -->
                            </label>
                        </div>
                        <!-- Choice B -->
                        <div class="form-check col-lg-12">
                            <label class="form-check-label">
                                <div id="choice2"></div>    
                                <!-- <input class="form-check-input" type="radio" name="choices" value="B">
                                <span class="font-weight-bold mx-1">&nbsp;b.&nbsp;</span><span id="choice2" ></span> -->
                            </label>
                        </div>
                        <!-- Choice C -->
                        <div class="form-check col-lg-12">
                            <label class="form-check-label">
                                <div id="choice3"></div>
                                <!-- <input class="form-check-input" type="radio" name="choices" value="C">
                                <span class="font-weight-bold mx-1">&nbsp;c.&nbsp;</span><span id="choice3" ></span> -->
                            </label>
                        </div>
                        <!-- Choice D -->
                        <div class="form-check col-lg-12">
                            <label class="form-check-label">
                                <div id="choice4"></div>
                                <!-- <input class="form-check-input" type="radio" name="choices" value="D">
                                <span class="font-weight-bold mx-1">&nbsp;d.&nbsp;</span><span id="choice4" ></span> -->
                            </label>
                        </div>
                    </div>
                    <!-- /.row(question) -->
                    <!-- Next and Prev Button -->
                    <div class="row mt-3 p-3 p-0" style="border-top:1px solid #e2e1e1;">
                        <!-- <div class="col-6 text-right" id="previous">
                            <button class='button-exam' onclick="prev();">Prev</button>
                        </div> -->
                        <div class="col-lg-12 text-center p-0" id="sunod">
                            <!-- <button class='button-exam' onclick="next();">Next</button> -->
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>    
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>
<!-- /.wrapper -->
    <?php include_once("../includes/home/js.php") ?>
</body>