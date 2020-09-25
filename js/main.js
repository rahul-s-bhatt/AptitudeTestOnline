
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

const myQuestions = [
  {
    question: "What is a array?",
    answers: {
      a: "An array is a series of elements of the same type in contiguous memory locations",
      b: "An array is a series of element",
      c: "An array is a series of elements of the same type placed in non-contiguous memory locations",
      d: "None of the mentioned"
    },
    correctAnswer: "a"
  },
  {
    question: "What is the output of this program?<br>#include < stdio.h ><br>using namespace std;<br>int main(){<br>char str[5] = &quot;ABC&quot;;<br>cout << str[3];<br>cout << str;<br>return 0;}",
    answers: {
      a: "ABC",
      b: "ABCD",
      c: "AB",
      d: "None of the mentioned"
    },
    correctAnswer: "a"
  },
  {
    question: "How many specifiers are present in access specifiers in class?",
    answers: {
      a: "1",
      b: "2",
      c: "3",
      d: "4"
    },
    correctAnswer: "c"
  },
  {
    question: "How many kinds of classes are there in c++?",
    answers: {
      a: "1",
      b: "2",
      c: "3",
      d: "4"
    },
    correctAnswer: "c"
  },
  {
    question: "which of the following is used to implement the c++ interfaces?",
    answers: {
      a: "absolute variables",
      b: "abstract classes",
      c: "constant variables",
      d: "none of the mentioned"
    },
    correctAnswer: "b"
  },
  {
    question: "#include is called",
    answers: {
      a: "Preprocessor directive",
      b: "Inclusion directive",
      c: "File inclusion directive",
      d: "None of the mentioned"
    },
    correctAnswer: "a"
  },
  {
    question: "If #include is used with file name in angular brackets",
    answers: {
      a: "The file is searched for in the standard compiler include paths",
      b: "The search path is expanded to include the current source directory",
      c: "Both a & b",
      d: "None of the mentioned"
    },
    correctAnswer: "a"
  },
  {
    question: " An expression involving byte, int, and literal numbers is promoted to which of these?",
    answers: {
      a: "int",
      b: "long",
      c: "byte",
      d: "float"
    },
    correctAnswer: "a"
  },
  {
    question: "Which four options describe the correct default values for array elements of the types indicated?<br>int -> 0<br>String -> &quot;null&quot;  <br>Dog -> null<br>char -> &apos;\\u0000&apos;<br>float -> 0.0f<br>boolean -> true",
    answers: {
      a: "1,2,3,4",
      b: "1,3,4,5",
      c: "2,4,5,6",
      d: "3,4,5,6"
    },
    correctAnswer: "b"
  },
  {
    question: "Which will legally declare, construct, and initialize an array?",
    answers: {
      a: "int [] myList = {&quot;1&quot;, &quot;2&quot;, &quot;3&quot;};",
      b: "int [] myList = (5, 8, 2);",
      c: "int myList [] [] = {4,9,7,0};",
      d: "int myList [] = {4, 3, 7};"
    },
    correctAnswer: "d"
  },
  {
    question: "Which is a reserved word in the Java programming language?",
    answers: {
      a: "method",
      b: "native",
      c: "subclasses",
      d: "array"
    },
    correctAnswer: "b"
  },
  {
    question: "Which three are legal array declarations?<br>1. int [] myScores [];<br>2. char [] myChars;<br>3. int [6] myScores;<br>4. Dog myDogs [];<br>5. Dog myDogs [7];",
    answers: {
      a: "1,2,4",
      b: "2,4,5",
      c: "2,3,4",
      d: "All are correct."
    },
    correctAnswer: "a"
  }
];



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
  var testName = "ATT ver 4";
  GetValue(numCorrect, len, wrong, testName);
}

// display quiz right away
buildQuiz();

// on submit, show results
submitButton.addEventListener('click', showResults);


var deadline = new Date("Mar 19, 2020 20:30:00").getTime(); 

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
