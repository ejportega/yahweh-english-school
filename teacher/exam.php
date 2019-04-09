<?php
    include_once("../includes/home/header.php");
?>

<script type="text/javascript">
var test, pos = 0, score = 0, chA, chB, chC, chD, choices, choice1, choice2, choice3, choice4, question, item, sunod, previous;
var questions = [
["Jack's parents <u class='undeline-spaces'>_________________</u> and so I am sure they would love to go the exhibition.", "like very much Picasso's paintings", "like Picassos's paintings very much", "much Picassos's paintings like", "much like Picassos' paintings", "B"],
["Please don't forget to ring me when you <u class='undeline-spaces'>_________________</u> home.", "will get", "get", "are going to get", "are getting", "B"],
["I am sure I would have regretted it if I <u class='undeline-spaces'>_________________</u> to take the job.", "would agree", "would have agreed", "did agree", "had agreed", "B"],
["Did you have any problems <u class='undeline-spaces'>_________________</u> our house?.", "find", "to find", "finding", "for finding", "C"],
["The police are <u class='undeline-spaces'>_________________</u> an investigation into the robbery.", "carrying out", "working out", "searching out", "making out", "B"],
["I didn't <u class='undeline-spaces'>_________________</u> listen to opera.", "used to", "use to", "never", "be used to", "B"],
["I hope you don't mind <u class='undeline-spaces'>_________________</u> joining you.", "to be", "I had been", "that I may", "my", "A"],
["I really didn't think there <u class='undeline-spaces'>_________________</u> any gateau left.", "has been", "will have been", "would be", "is", "C"],
["If I <u class='undeline-spaces'>_________________</u> phone you, I'll see you at seven.", "do", "will", "don't", "may", "A"],
["We had a great time, <u class='undeline-spaces'>_________________</u> the awful weather.", "except", "but for", "in spite", "spite of", "C"],
["Soldiers have been sent in to try to restore <u class='undeline-spaces'>_________________</u> in the area.", "organisation", "harmony", "order", "regulation", "B"],
["Suzie and Jogn are planning to get married and <u class='undeline-spaces'>_________________</u> a lot of children.", "have", "bring", "get", "make", "A"],
["When Sam was a small child, he <u class='undeline-spaces'>_________________</u> spend hourse every day playing with stones in the garden.", "would", "was", "used", "should", "A"],
["You should read this novel — it's been <u class='undeline-spaces'>_________________</u> recommended by all the critics.", "highly", "truly", "fully", "deeply", "A"],
["The teacher asked if <u class='undeline-spaces'>_________________</u> to bring our textbooks to class.", "all we had remembered", "had we all remembered", "we had all remembered", "had we all remembered", "B"]
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
    // previous = _("previous");
    question = questions[pos][0];
    chA = questions[pos][1];
    chB = questions[pos][2];
    chC = questions[pos][3];
    chD = questions[pos][4];

    item.innerHTML = (pos + 1) + " of 15";
    test.innerHTML = question;
    choice1.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='A'><span class='mx-3 font-weight-bold'>a.</span>" + chA; 
    choice2.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='B'><span class='mx-3 font-weight-bold'>b.</span>" + chB;
    choice3.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='C'><span class='mx-3 font-weight-bold'>c.</span>" + chC;
    choice4.innerHTML = "<input class='form-check-input' type='radio' name='choices' value='D'><span class='mx-3 font-weight-bold'>d.</span>" + chD; 
    // previous.innerHTML = "<button class='button-exam' onclick=prev()>Prev</button>"
    // sunod.innerHTML = "<button class='button-exam' onclick=next()>Next</button>"; 
    if (pos < 14) {
        sunod.innerHTML = "<button id='btn-next' class='btn btn-outline-success' onclick=next()>Next</button>"; 
        console.log(pos);
    }
    else {
        console.log("uban");
        // sunod.innerHTML = "<a href='#'><button class='button-exam' onclick=\"confirm('Are you done answering the test?')\">Done</button></a>"; 
        // sunod.innerHTML = "<a href='exam-result.php?score=" +score+ "'><button class='button-exam'>Done</button></a>";
        sunod.innerHTML = "<button class='btn btn-outline-success' onclick=next()>Done</button>";
    }
   
}

function next() {
    answer = questions[pos][5];
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
        if (pos < 14) {
            pos++;
            var isChecked = choices.checked;
            renderQuestion();
        }          
        else {
            window.location.href =  "exam-result.php?score=" + score;
        }
    }
    else {
        alert("Please choose the best answer");
    }  
}

function displayResult() {
    
}

// function prev() {
//     answer = questions[pos][5];
//     if (pos > 0) {
//         pos--;
//         renderQuestion();
//     }
// }

window.addEventListener("load", renderQuestion, false);
</script>
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
                                    window.location.href =  "exam-result.php?score=" + score;
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