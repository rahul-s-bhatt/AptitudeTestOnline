<?php 
  include 'server.php';
  
  $getTestName = $_GET['testName'];

  $query = "SELECT * FROM scoreboard WHERE testName = '$getTestName'";
  $result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html>
<head>
      <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="styles/style.css">

  <title>Test Score Page</title>
</head>
<body>
  
  <div class="leaderboardSection">
    <table cellspacing="10" class="leaderboard">
            <tr>
              <th><?php echo $getTestName; ?></th>
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
                  while($row = mysqli_fetch_assoc($result)) {
                    $logID = $row['loginID'];

                    $corr = $row['correct'];
                    $outOf = $row['outOf'];
                    $wrong = $row['wrong'];

                    $query2 = "SELECT loginUsername FROM loginTable WHERE loginID = '$logID' ORDER BY '$corr' DESC";

                    $result2 = mysqli_query($conn, $query2);
                    $row2 = mysqli_fetch_assoc($result2);

                    $userNameId = $row2['loginUsername'];

                    $return = "<tr> <td>$userNameId</td> <td>$corr</td> <td>$outOf</td> <td>$wrong</td> <td>$getTestName</td></tr>";
                      echo $return;
                  }
              ?>
         </table>

        <button id="viewTest" name="viewTest" value="submit">View Answer</button> 

        <a href="index.php">Home</a>

      </div>

      <div id="quiz" style="display: none;"></div>

     <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script type="text/javascript">
        const quizContainer = document.getElementById('quiz');
        const resultsContainer = document.getElementById('results');
        const submitButton = document.getElementById('viewTest');

        const myQuestions = [
          
          {
            question: "We should travel ________ night, as it will be cooler.",
            answers: {
              a: "in",
              b: "at",
              c: "with",
              d: "by"
            },
            correctAnswer: "a",
            explanation: "Come on, bro its grammar!"
          },

          {
            question: "The seller lowered the prices.",
            answers: {
              a: "The prices lowered the seller.",
              b: "The prices were lowered by the seller.",
              c: "Down went the price",
              d: "The prices lowered by the seller."
            },
            correctAnswer: "b",
            explanation: "The prices were lowered by the seller."
          },

          {
            question: "I prefer to staying indoors, rather than going out on a hot afternoon.",
            answers: {
              a: "I prefer in staying indoors than",
              b: "I prefer staying indoors to",
              c: "I prefer stay indoors to",
              d: "I would prefer to staying indoors than",
              e: "No correction required"
            },
            correctAnswer: "b",
            explanation: "‘Staying indoors’ and ‘going out’ are the options. ‘To’ should be used instead of ‘rather than’."
          },

          {
            question: "Can you help me with a thousand rupees?",
            answers: {
              a: "interrogative",
              b: "negative",
              c: "complex",
              d: "compound"
            },
            correctAnswer: "a",
            explanation: "if you got thousand rupees share it with me lol !"
          },

          {
            question: "It is surprising to note that his latest publication has attracted very little public attention because generally his writings are prone to<br>(A) fracas<br>(B)<br>denials<br>(C)<br>tributes<br>(D) defects<br>(E)<br>controversies<br>(F) disputation",
            answers: {
              a: "A and D",
              b: "A and B",
              c: "C and D",
              d: "A and E",
              e: "E and F"
            },
            correctAnswer: "e",
            explanation: "His writings attract attention as they are prone to ‘controversies’ or ‘disputations’."
          },

          {
            question: "Identify the tense:<br> Suganya is typing.",
            answers: {
              a: "simple past",
              b: "simple present",
              c: "present continous",
              d: "past perfect"
            },
            correctAnswer: "c",
            explanation: "present continous: because of *ing."
          },

          {
            question: "Relate this word to the options below:<br>ALTRUISM",
            answers: {
              a: "misery",
              b: "indifference",
              c: "veracity",
              d: "generosity",
              e: "selfishness"
            },
            correctAnswer: "b",
            explanation: "Generosity (munificence, large-hoartodness) and altruism are synonyms"
          },

          {
            question: "Correct the tense: The employees hope that the management would concede their demands.",
            answers: {
              a: "would concede to their",
              b: "will concede to its",
              c: "will concede to their",
              d: "will concede with their"
            },
            correctAnswer: "c",
            explanation: "When ‘hope’ is in the present tense, it is followed by ‘will’ and not ‘would’. ‘Concede’ is always followed by ‘to’ and not ‘with’. Employees is a plural noun indicated by the preposition ‘their’. Hence the correction is ‘the management will concede to their demands’."
          },

          {
            question: "Like CONVICTION: INCARCERATION then:",
            answers: {
              a: "reduction : diminution",
              b: "induction : amelioration",
              c: "radicalization : estimation",
              d: "marginalization : intimidation"
            },
            correctAnswer: "a",
            explanation: "A conviction results in incarceration; a reduction results in diminution."
          },

          {
            question: "Here are some words translated from an artificial language.<br>migenlasan means cupboard<br>lasanpoen means boardwalk<br>cuopdansa means pullman<br>Which word could mean “walkway”?",
            answers: {
              a: "poenmigen",
              b: "cuopeisel",
              c: "lasandansa",
              d: "poenforc"
            },
            correctAnswer: "d",
            explanation: "Migen means cup; lasan means board; poen means walk; cuop means pull; and dansa means man. The only possible choices, then, are choices a and d. Choice a can be ruled out because migen means cup."
          },

          {
            question: "PULSATE: THROB then:",
            answers: {
              a: "walk : run",
              b: "tired : sleep",
              c: "examine : scrutinize",
              d: "ballet : dancer",
              e: "find : lose"
            },
            correctAnswer: "c",
            explanation: "Pulsate and throb are synonyms, as are examine and scrutinize."
          }

        ];


        function buildQuiz(){
            // variable to store the HTML output
            const output = [];
            const explanation = [];

            // for each question...
            myQuestions.forEach(
              (currentQuestion, questionNumber) => {

                // variable to store the list of possible answers
                const answers = [];

                for(letter in currentQuestion.answers){

                  // ...add an HTML radio button
                  
                  if(letter === currentQuestion.correctAnswer){
                      answers.push(
                      `<label style="color: green;" > 
                        (${letter})
                        ${currentQuestion.answers[letter]}
                      </label><br>`
                    );
                  }else{
                    answers.push(
                      `<label  style="color: red;" > 
                        (${letter})
                        ${currentQuestion.answers[letter]}
                      </label><br>`
                    );
                  }
                }

                // add this question and its answers to the output
                output.push(
                  `<br><div class="question"> Q${questionNumber+1}. ${currentQuestion.question} </div>
                  <div class="answers"> ${answers.join('')} <br></div>
                  <div class="explanation">Explanation: <br> ${currentQuestion.explanation} <br></div>`
                );
              }
            );

            // finally combine our output list into one string of HTML and put it on the page
            quizContainer.innerHTML = output.join('');
        }
        
        // on submit, show results
        submitButton.addEventListener('click', buildQuiz);

        $('#viewTest').click(function() {
           $('#quiz').css('display', 'block');
          document.getElementById("viewTest").style.display = "none";
        });
        

    </script>

</body>
</html>