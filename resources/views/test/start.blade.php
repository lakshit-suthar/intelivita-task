<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Start Test') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div id="question-container" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white p-4 rounded-lg"></div>
        <div id="timer" class="mt-4 text-center text-gray-800 dark:text-gray-200">Time remaining: <span id="timer-display"></span> seconds</div>
        <div id="answer-container" class="mt-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg"></div>
        <button id="submit-answer" class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Submit Answer</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var questions;
            var currentQuestionIndex;
            var remainingTime;
            var timerInterval;
    
            function fetchQuestions() {
                fetch("/questions")
                    .then(response => response.json())
                    .then(data => {
                        questions = data;
                        currentQuestionIndex = getCurrentQuestionIndex();
                        remainingTime = getRemainingTime();
                        if (isNaN(currentQuestionIndex) || currentQuestionIndex < 0 || currentQuestionIndex >= questions.length) {
                            currentQuestionIndex = 0; // Reset currentQuestionIndex to 0 if it's invalid
                        }
                        displayQuestion(currentQuestionIndex);
                        startTimer(remainingTime);
                    })
                    .catch(error => console.error("Error fetching questions:", error));
            }
    
            function getCurrentQuestionIndex() {
                var storedIndex = localStorage.getItem("currentQuestionIndex");
                return storedIndex ? parseInt(storedIndex) : 0; // Return 0 if storedIndex is not found or invalid
            }
    
            function getRemainingTime() {
                var storedTime = localStorage.getItem("remainingTime");
                return storedTime ? parseInt(storedTime) : 0;
            }
    
            function saveState() {
                localStorage.setItem("currentQuestionIndex", currentQuestionIndex.toString());
                localStorage.setItem("remainingTime", remainingTime.toString());
            }
    
            function displayQuestion(index) {
                var questionContainer = document.getElementById("question-container");
                var answerContainer = document.getElementById("answer-container");
    
                questionContainer.textContent = questions[index].question_text;
                answerContainer.innerHTML = ""; // Clear previous answer options
    
                // Create radio buttons for each answer option
                questions[index].answers.forEach(function(answer, i) {
                    var radioWrapper = document.createElement("div");
                    radioWrapper.className = "flex items-center mb-2";
    
                    var radioBtn = document.createElement("input");
                    radioBtn.type = "radio";
                    radioBtn.name = "answer";
                    radioBtn.value = answer.id;
                    radioBtn.id = "answer" + i;
                    radioBtn.className = "mr-2";
    
                    var label = document.createElement("label");
                    label.setAttribute("for", "answer" + i);
                    label.textContent = answer.answer_text;
                    label.className = "text-gray-800 dark:text-gray-200";
    
                    radioWrapper.appendChild(radioBtn);
                    radioWrapper.appendChild(label);
                    answerContainer.appendChild(radioWrapper);
                });
            }
    
            function startTimer(seconds) {
                var timerDisplay = document.getElementById("timer-display");
                var totalSeconds = seconds;
    
                timerInterval = setInterval(function() {
                    totalSeconds--;
                    remainingTime = totalSeconds;
                    saveState();
                    timerDisplay.textContent = totalSeconds;
    
                    if (totalSeconds <= 0) {
                        clearInterval(timerInterval);
                        nextQuestion();
                    }
                }, 1000);
            }
    
            function nextQuestion() {
                currentQuestionIndex++;
                if (currentQuestionIndex < questions.length) {
                    displayQuestion(currentQuestionIndex);
                    startTimer(questions[currentQuestionIndex].time_limit);
                } else {
                    // No more questions, end of test
                    clearInterval(timerInterval);
                    // alert("End of test");
                    // Redirect to thank you page
                    window.location.href = "/test/thank-you"; // Commented out to keep the test page open after answering all questions
                }
            }
    
            function submitAnswer() {
                clearInterval(timerInterval); // Stop the timer
                var selectedAnswer = document.querySelector('input[name="answer"]:checked');
                if (selectedAnswer) {
                    var answerId = selectedAnswer.value;
                    console.log("Submitting answer:", answerId);
                    // Send the answer to the backend API
                    fetch("/test/submit", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                question_id: questions[currentQuestionIndex].id,
                                answer_id: answerId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Handle response from the backend if needed
                            console.log("Response from server:", data);
                            // Move to the next question
                            nextQuestion();
                        })
                        .catch(error => console.error("Error submitting answer:", error));
                } else {
                    alert("Please select an answer.");
                }
            }
    
            // Event listener for answer submission
            document.getElementById("submit-answer").addEventListener("click", submitAnswer);
    
            // Fetch questions when the page loads
            fetchQuestions();
    
            // Prevent page refresh
            window.addEventListener('beforeunload', function(e) {
                // Cancel the event
                e.preventDefault();
                // Chrome requires returnValue to be set
                e.returnValue = '';
            });
        });
    </script>
</x-app-layout>
