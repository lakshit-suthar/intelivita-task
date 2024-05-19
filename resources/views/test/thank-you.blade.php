<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Thank You') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div id="result-container" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white p-4 rounded-lg">
            <h3 class="text-lg font-semibold">Your Results</h3>
            <ul id="result-list" class="mt-4"></ul>
            <div id="percentage" class="mt-4 text-center text-gray-800 dark:text-gray-200"></div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetchResults();

            function fetchResults() {
                fetch("/test/results")
                    .then(response => response.json())
                    .then(data => {
                        displayResults(data.results);
                        displayPercentage(data.percentage);
                    })
                    .catch(error => console.error("Error fetching results:", error));
            }

            function displayResults(results) {
                var resultList = document.getElementById("result-list");
                resultList.innerHTML = "";

                results.forEach(result => {
                    var listItem = document.createElement("li");
                    listItem.className = "mb-2 p-2 bg-gray-100 dark:bg-gray-700 rounded";

                    var questionText = document.createElement("div");
                    questionText.className = "text-gray-800 dark:text-gray-200 font-semibold";
                    questionText.textContent = result.question_text;

                    var answerText = document.createElement("div");
                    answerText.className = result.is_correct ? "text-green-600 dark:text-green-400" : "text-red-600 dark:text-red-400";
                    answerText.textContent = "Your answer: " + result.answer_text;

                    listItem.appendChild(questionText);
                    listItem.appendChild(answerText);
                    resultList.appendChild(listItem);
                });
            }

            function displayPercentage(percentage) {
                var percentageDiv = document.getElementById("percentage");
                percentageDiv.textContent = "Your score: " + percentage.toFixed(2) + "%";
            }
        });
    </script>
</x-app-layout>
