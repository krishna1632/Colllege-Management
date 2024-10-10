@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add Question</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="questionForm" action="{{ route('admin.questions.store', $quiz->id) }}" method="POST">
            @csrf
            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            <div id="questions_container">
                <div class="question_block">
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Question</label>
                        <input type="text" class="form-control question_text" name="question_text[]" required>
                    </div>
                    <div class="mb-3">
                        <label for="options_count" class="form-label">How many options do you want to create?</label>
                        <select class="form-select options_count" onchange="handleOptionsCountChange(this)">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="options_container"></div>
                    <div class="mb-3">
                        <label for="correct_option" class="form-label">Correct Option</label>
                        <select class="form-select correct_option" name="correct_option" required>
                            <option value="">Select Correct Option</option>
                            <!-- Options will be dynamically added -->
                        </select>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-secondary" id="add_another">Add Another Question</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.questions.index', $quiz_id) }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script>
        function handleOptionsCountChange(selectElement) {
            const count = selectElement.value;
            const container = selectElement.closest('.question_block').querySelector('.options_container');
            const correctOptionSelect = selectElement.closest('.question_block').querySelector('.correct_option');
            createOptionInputs(count, container, correctOptionSelect);
        }

        function createOptionInputs(count, container, correctOptionSelect) {
            container.innerHTML = ''; // Clear previous inputs
            correctOptionSelect.innerHTML = '<option value="">Select Correct Option</option>'; // Reset correct options

            for (let i = 0; i < count; i++) {
                const input = document.createElement('input');
                input.type = 'text';
                input.placeholder = `Option ${i + 1}`;
                input.className = 'form-control';
                input.name = "options[][]"; // Ensure that name is correct for array structure
                container.appendChild(input);

                // Add the option to the correct options dropdown
                const option = document.createElement('option');
                option.value = `Option ${i + 1}`;
                option.textContent = `Option ${i + 1}`;
                correctOptionSelect.appendChild(option);
            }
        }

        document.getElementById('add_another').addEventListener('click', function() {
            const newQuestionBlock = document.querySelector('.question_block').cloneNode(true);
            newQuestionBlock.querySelectorAll('input[type="text"]').forEach(input => input.value = '');
            newQuestionBlock.querySelector('.options_container').innerHTML = ''; // Clear options
            newQuestionBlock.querySelector('.correct_option').innerHTML =
                '<option value="">Select Correct Option</option>'; // Reset correct option
            document.getElementById('questions_container').appendChild(newQuestionBlock);
        });
    </script>
@endsection
