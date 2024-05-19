<x-admin-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-center text-gray-800 dark:text-gray-200 leading-tight w-full">
            {{ isset($question) ? __('Edit Question') : __('Create Question') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8">
        <div class="flex justify-center">
            <div class="w-full max-w-md">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    @if (session('success'))
                        <div class="mb-4 text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="question-form" method="POST" action="{{ isset($question) ? route('admin.questions.update', $question) : route('admin.questions.store') }}">
                        @csrf
                        @if (isset($question))
                            @method('PUT')
                        @endif

                        <div class="mb-4">
                            <label for="question_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Question Text') }}</label>
                            <input id="question_text" type="text" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50 @error('question_text') border-red-500 @enderror" name="question_text" value="{{ old('question_text', $question->question_text ?? '') }}" required autofocus>
                            @error('question_text')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="time_limit" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Time Limit (seconds)') }}</label>
                            <input id="time_limit" type="number" min="1" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-300 dark:focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-700 focus:ring-opacity-50 @error('time_limit') border-red-500 @enderror" name="time_limit" value="{{ old('time_limit', $question->time_limit ?? '') }}" required>
                            @error('time_limit')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="answers-section" class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Answers') }}</label>
                            @php
                                $answers = old('answers', isset($question) ? $question->answers : []);
                                $defaultAnswerCount = max(4, count($answers)); // Make sure we display at least 4 answer fields
                            @endphp
                            @for ($index = 0; $index < $defaultAnswerCount; $index++)
                                @php
                                    $answer = $answers[$index] ?? ['answer_text' => '', 'is_correct' => false];
                                @endphp
                                <div class="mt-2">
                                    <div class="flex items-center">
                                        <input type="text" name="answers[{{ $index }}][answer_text]" value="{{ old('answers.'.$index.'.answer_text', $answer['answer_text']) }}" class="form-input rounded-md shadow-sm w-full @error('answers.'.$index.'.answer_text') border-red-500 @enderror" placeholder="Answer text" required> <!-- Add 'required' attribute -->
                                        <input type="checkbox" name="answers[{{ $index }}][is_correct]" value="1" class="ml-2 @error('answers.'.$index.'.is_correct') border-red-500 @enderror" {{ old('answers.'.$index.'.is_correct', $answer['is_correct']) ? 'checked' : '' }}>
                                    </div>
                                    @error('answers.'.$index.'.answer_text')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endfor
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" id="add-answer" class="px-4 py-2 bg-green-500 text-white rounded-md">{{ __('Add Answer') }}</button>
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 dark:hover:bg-blue-500 focus:outline-none focus:border-blue-700 dark:focus:border-blue-500 focus:ring focus:ring-blue-200 dark:focus:ring-blue-700 active:bg-blue-600 disabled:opacity-25 transition">{{ isset($question) ? __('Update') : __('Create') }}</button>
                                <a href="{{ route('admin.questions.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-500 focus:outline-none focus:border-gray-700 dark:focus:border-gray-500 focus:ring focus:ring-gray-200 dark:focus:ring-gray-700 active:bg-gray-600 disabled:opacity-25 transition">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

   
</x-admin-app-layout>
