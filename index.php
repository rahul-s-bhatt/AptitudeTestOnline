<?php
    
    include('server.php');

    if(!isset($_SESSION['username'])){
      ?> 
        <script>window.location.href = "login.php";</script>
      <?php
      exit;
      }else{ ?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="styles/style.css">

    <title>Online Aptitude Test!</title>
  </head>
  <body>

    <nav>
      <p>Navigate here!</p>
      <a href="index.php">Home</a>
      <a href="codingTest.php">Coding Test</a>
      <a href="placementPrep.php">Placement Prep</a>
    </nav>

    <h1>Hello,
      <?php 
          if(isset($_SESSION['username'])){
            echo $_SESSION['username']."<a href='logout.php'><img style = 'width: 32px; height: 32px;' src='img/logout.png' /></a>";
          }?>
    </h1>

  <div class="container">
   <div class="row">
      <div class="col-6">
         <p>TEST ON Capgemini ver 2 APTITUDE TEST!</p>
         <p>Based on Logical Reasoning, Number Series, Decision Making, Problems based on Ages. </p>
         <br>
         <p id="timer">
              Timer: <br> Days : Hours: Minutes: Seconds
           <div id="divTimer">
              <span id="day"></span> <span>d: </span> <span id="hour"></span> <span>hr: </span> <span id="minute"></span>  <span>min: </span><span id="second"></span><span>s</span>
           </div>
         </p>
         
         <div id="quiz" style="display: none;">
         </div>
         <button id="startBtn" name="startTest" value="start" style = "background: grey; color: black;" disabled="true">Start Quiz</button>

         <form name="Results" method="POST">
            <div id="results"></div>        
            <button style="display: none;" id="submit" name="submitTest" value="submit">Submit Quiz</button>    
         </form>


      </div>
      <div class="col-6" style="text-align: center;">
         <!-- Form for text input that is chat -->

         <!-- <div id="chatHogaIdhar" style=""></div> -->
         <!-- <form method="POST">
            <div class="form-group">
              <input type="text" class="form-control" name="chatText" aria-describedby="chatHelp" placeholder="Chat here!">
            </div>
            <button type="submit" value="submit" name="submitText" class="btn btn-primary">Chat</button>
            
            </form> -->
         <h1>TIME TABLE</h1>
         <table cellspacing="10">
            <tr>
               <th>Date</th>
               <th>Test Name</th>
               <th>Test Category</th>
            </tr>
            <tr>
               <td>22/3/2020</td>
               <td>Capgemini ver 2</td>
               <td>Logical Reasoning <a href="https://www.indiabix.com/logical-reasoning/questions-and-answers/"> much more! </a> </td>
            </tr>
            <tr>
               <td>For more message or email me!</td>
               <td><a href="https://www.gmail.com">rahulbhatt1899@gmail.com</a></td>
               <td>See ya later!</td>
            </tr>
         </table>

         <h1>Score Board</h1>
         <table cellspacing="10" class="leaderboard">
          <tr>
            <th>Name</th>
            <th colspan="4">Score</th>
          </tr>
          <tr>
            <th></th>
            <th>Correct</th>
            <th>outOf</th>
            <th>Wrong</th>
            <th>TestName</th>
          </tr>
            <?php

                $query = "SELECT * FROM tests";
                $result = mysqli_query($conn, $query);

                  while($row = mysqli_fetch_assoc($result)) {
                  
                  $testName = $row['testName'];

                  $return = "<tr><td>To check </td><td>score click</td><td>on testName! </td><td> -> </td><td><a href='individual.php?testName=$testName'>$testName</a></td></tr>";
                    echo $return;
                }
            ?>
         </table>
      </div>
   </div>
  </div>
<?php } ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
    <!-- script for index -->

    <script type="text/javascript">
        function GetValue(numCorrect, outOf, wrong, testName) {
          $.ajax({
              type: 'POST',
              url: 'submission.php',
              data: {
                  nC: numCorrect,
                  outOf: outOf,
                  wrong: wrong,
                  testName: testName
              },
              success: function(data) {
              }
          });
        }
        // function getChatText() {
        //   $.ajax({
        //     type: 'GET',
        //     url: 'getData.php',
        //     success: function (res){
        //         $( '#chatHogaIdhar' ).html(res);
        //     }
        //   });
        
        // }
        // setInterval(getChatText(), 1000);

        // $(document).ready(function(){
        //  setInterval(getChatText, 1000);
        // });


        const quizContainer = document.getElementById('quiz');
        const resultsContainer = document.getElementById('results');
        const submitButton = document.getElementById('submit');

        const myQuestions = [{ question:"Q. A's and B's age are in the ratio of 4:5. Four years hence, the ratio of their ages will become 5:6. What is B's present age?",answers: {A:"25 years",B:"20 years",C:"30 years",D:"40 years"},correctAnswer:"B",explanation:"<br> copy karna bhul gaya sorry.<br> <br> "},{ question:" Q. A father said his son: I was as old as you are at present at the time of your birth. If the father age is 38 now, the son age 5 years back was?",answers: {A:"14  ",B:"19",C:"33  ",D:"38"},correctAnswer:"A",explanation:"<br> Let the son's present age be x years Then, (38 - x) = x => x= 19 <br> Son's age 5 years back = (19 - 5) = 14 years<br> <br> "},{ question:" Q. In 10 years, A will be twice as old as B was 10 years ago. If A is now 9 years older than B, the present age of B is?",answers: {A:"19",B:"29",C:"39",D:"49"},correctAnswer:"C",explanation:"<br> Let B's present age = x years. Then, A's present age = (x + 9) years.<br> (x + 9) + 10 = 2(x - 10)<br>  => x + 19 = 2x - 20<br>  => x =39.<br> <br> "},{ question:" Q. The total age of X and Y is 12 years more than the total age of Y and Z, Z is how many years younger than X?",answers: {A:"12",B:"13",C:"14",D:"15"},correctAnswer:"A",explanation:"<br> (X+Y) - (Y+Z) = 12<br> X - Z = 12.<br> Z is younger than X by 12 years.<br> <br> "},{ question:" Q. The sum of the present ages of a father and his son is 60 years. five years ago, father's age was four times the age of the son. so now the son's age will be?",answers: {A:"5",B:"10",C:"15",D:"20"},correctAnswer:"C",explanation:"<br> Let the present ages of son and father be x and (60 -x) years respectively.<br> Then, (60 - x) - 5= 4(x - 5)<br> 55 - x = 4x - 20<br> 5x = 75  => x = 15<br> <br> "},{ question:" Q. "I am five times as old as you were, when I was as old as you are", said a man to his son. Find out their present ages, if the sum of their ages is 64 years?",answers: {A:"Father = 50; Son = 14",B:"Father = 40; Son = 24",C:"Father = 60; Son = 4",D:"Father = 48; Son = 16"},correctAnswer:"B",explanation:"<br> Let the present age of the man be 'P' and son be '"},{ question:" Q. The ratio of the ages of Maala and Kala is 4 : 3. The total of their ages is 2.8 decades. The proportion of their ages after 0.8 decades will be [1 Decade = 10 years]?",answers: {A:"4",B:"12:11",C:"7:4",D:"6:5"},correctAnswer:"D",explanation:"<br> Let, Maala's age = 4A and Kala's age = 3A<br> Then 4A + 3A = 28<br> A = 4<br> Maala's age = 16 years<br> and Kala's age = 12 years<br> Proportion of their ages after 8 is = (16 + 8) : (12 + 8)<br> = 24 : 20<br> = 6 : 5<br> <br> "},{ question:" Q. Sachin is younger than Rahul by 7 years. If the ratio of their ages is 7:9, find the age of Sachin?",answers: {A:"24.5",B:"25.5",C:"26.5",D:"27.5"},correctAnswer:"A",explanation:"<br> If Rahul age is x, then Sachin age is x - 7,<br> so, (x-7)/x =7/9<br> 9x - 63 = 7x<br> 2x = 63<br> x = 31.5<br> So Sachin age is 31.5 - 7 = 24.5<br> <br> "},{ question:" Q. When I was married 10 years ago my wife is the 6th member of the family. Today my father died and a baby born to me.The average age of my family during my marriage is same as today. What is the age of Father when he died ?",answers: {A:"50 yrs",B:"60 yrs",C:"70 yrs",D:"65 yrs"},correctAnswer:"B",explanation:"<br> Let the Father be x years when he died<br> <br> Average Age 10 years ago be A<br> <br> Total Age 10 years ago = 6*A<br> <br> Total Age after 10 years(Just before father's Death) = 6A + 6*10 = 6A + 60<br> <br> Father Died and Baby was born => the Total number of people in the family is Same (6)<br> Baby born today so age of baby = 0<br> <br> (6A +60 - x)/6 = 6A/6<br> => A + 10 -(x/6) = A<br> => x/6 = 10<br> => x = 60<br> <br> Therefore we can conclude that the father was 60 years old when he died.<br> <br> "}];




        function buildQuiz(){
            // variable to store the HTML output
            const output = [];

            // for each question...
            myQuestions.forEach(
              (currentQuestion, questionNumber) => {

                // variable to store the list of possible answers
                const answers = [];

                // and for each available answer...
                for(letter in currentQuestion.answers){


                  // ...add an HTML radio button
                  answers.push(
                    `<label> 
                      (${letter}) <input type="radio" name="question${questionNumber}" value="${letter}">
                      ${currentQuestion.answers[letter]}
                    </label><br>`
                  );
                }

                // add this question and its answers to the output
                output.push(
                  `<div class="question"> Q${questionNumber+1}. ${currentQuestion.question} </div>
                  <div class="answers"> ${answers.join('')} <br></div>`
                );
              }
            );

            // finally combine our output list into one string of HTML and put it on the page
            quizContainer.innerHTML = output.join('');
        }
        var arrayAttr;

        function showResults() {
          // gather answer containers from our quiz
          const answerContainers = quizContainer.querySelectorAll('.answers');

          // keep track of user's answers
          let numCorrect = 0;

          // for each question...
          myQuestions.forEach((currentQuestion, questionNumber) => {

              // find selected answer
              const answerContainer = answerContainers[questionNumber];
              const selector = `input[name=question${questionNumber}]:checked`;
              const userAnswer = (answerContainer.querySelector(selector) || {}).value;

              // if answer is correct
              if (userAnswer === currentQuestion.correctAnswer) {
                  // add to the number of correct answers
                  numCorrect++;

                  // color the answers green
                  answerContainers[questionNumber].style.color = 'lightgreen';
              }
              // if answer is wrong or blank
              else {
                  // color the answers red
                  answerContainers[questionNumber].style.color = 'red';
              }
          });
          // show number of correct answers out of total
          
          resultsContainer.innerHTML = `Your score: ${numCorrect} out of ${myQuestions.length}`;
          var wrong = myQuestions.length - numCorrect;
          var len =  myQuestions.length;
          var testName = "Capgemini ver 3";
          GetValue(numCorrect, len, wrong, testName);
        }

        // display quiz right away
        buildQuiz();

        // on submit, show results
        submitButton.addEventListener('click', showResults);
        

        var deadline = new Date("April 7, 2020 20:30:00").getTime(); 

        var x = setInterval(function() { 
          
          var now = new Date().getTime(); 
          var t = deadline - now; 
          var days = Math.floor(t / (1000 * 60 * 60 * 24)); 
          var hours = Math.floor((t%(1000 * 60 * 60 * 24))/(1000 * 60 * 60)); 
          var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60)); 
          var seconds = Math.floor((t % (1000 * 60)) / 1000); 
          document.getElementById("day").innerHTML =days; 
          document.getElementById("hour").innerHTML = hours; 
          document.getElementById("minute").innerHTML = minutes;  
          document.getElementById("second").innerHTML = seconds;  
          if (t < 0) { 
            clearInterval(x);
            document.getElementById("timer").style.display = "none";                   
            document.getElementById("divTimer").style.display = "none";
            $('#startBtn').prop('disabled', false);
            document.getElementById("startBtn").style.background = "#008CBA";
            document.getElementById("startBtn").style.color = "white";
            
            } 
          }, 1000);

        $('#startBtn').click(function() {
          $('#quiz').css('display', 'block');
          document.getElementById("startBtn").style.display = "none";
          document.getElementById("submit").style.display = "block";
        });

        

    </script>
  </body>
</html>