/**
 * Exam Logic Module
 * Handles question display, navigation, timer, and submission
 */

class ExamManager {
    constructor(questions, duration) {
        this.questions = questions;
        this.currentQuestionIndex = 0;
        this.answers = {};
        this.duration = duration; // in seconds
        this.timeRemaining = duration;
        this.examStartTime = Date.now();
        this.timerInterval = null;
        
        // Store globally for cheating detection
        window.examQuestions = questions;
        window.examAnswers = this.answers;
        window.examStartTime = this.examStartTime;
        
        this.init();
    }
    
    init() {
        this.renderQuestion();
        this.startTimer();
        this.setupEventListeners();
    }
    
    renderQuestion() {
        const question = this.questions[this.currentQuestionIndex];
        if (!question) return;
        
        const container = document.getElementById('questionContainer');
        const currentNum = document.getElementById('currentQuestion');
        const progressFill = document.getElementById('progressFill');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        
        // Update question number
        currentNum.textContent = this.currentQuestionIndex + 1;
        
        // Update progress bar
        const progress = ((this.currentQuestionIndex + 1) / this.questions.length) * 100;
        progressFill.style.width = progress + '%';
        
        // Check if last question
        const isLastQuestion = this.currentQuestionIndex === this.questions.length - 1;
        nextBtn.style.display = isLastQuestion ? 'none' : 'inline-block';
        submitBtn.style.display = isLastQuestion ? 'inline-block' : 'none';
        
        // Render question HTML
        container.innerHTML = `
            <div class="question-card">
                <h2 class="question-text">${this.escapeHtml(question.question_text)}</h2>
                <div class="options-container">
                    <label class="option-label">
                        <input type="radio" name="answer" value="a" 
                               ${this.answers[this.currentQuestionIndex] === 'a' ? 'checked' : ''}>
                        <span class="option-text">A) ${this.escapeHtml(question.option_a)}</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="answer" value="b"
                               ${this.answers[this.currentQuestionIndex] === 'b' ? 'checked' : ''}>
                        <span class="option-text">B) ${this.escapeHtml(question.option_b)}</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="answer" value="c"
                               ${this.answers[this.currentQuestionIndex] === 'c' ? 'checked' : ''}>
                        <span class="option-text">C) ${this.escapeHtml(question.option_c)}</span>
                    </label>
                    <label class="option-label">
                        <input type="radio" name="answer" value="d"
                               ${this.answers[this.currentQuestionIndex] === 'd' ? 'checked' : ''}>
                        <span class="option-text">D) ${this.escapeHtml(question.option_d)}</span>
                    </label>
                </div>
            </div>
        `;
    }
    
    setupEventListeners() {
        // Next button
        document.getElementById('nextBtn').addEventListener('click', () => {
            this.saveAnswer();
            this.nextQuestion();
        });
        
        // Submit button
        document.getElementById('submitBtn').addEventListener('click', () => {
            if (confirm('Are you sure you want to submit the exam? You cannot change your answers after submission.')) {
                this.saveAnswer();
                this.submitExam();
            }
        });
        
        // Radio button change - auto-save
        document.addEventListener('change', (e) => {
            if (e.target.name === 'answer') {
                this.answers[this.currentQuestionIndex] = e.target.value;
                window.examAnswers = this.answers;
            }
        });
    }
    
    saveAnswer() {
        const selectedAnswer = document.querySelector('input[name="answer"]:checked');
        if (selectedAnswer) {
            this.answers[this.currentQuestionIndex] = selectedAnswer.value;
            window.examAnswers = this.answers;
        }
    }
    
    nextQuestion() {
        if (this.currentQuestionIndex < this.questions.length - 1) {
            this.currentQuestionIndex++;
            this.renderQuestion();
        }
    }
    
    startTimer() {
        this.updateTimerDisplay();
        
        this.timerInterval = setInterval(() => {
            this.timeRemaining--;
            this.updateTimerDisplay();
            
            if (this.timeRemaining <= 0) {
                this.timeUp();
            }
        }, 1000);
        
        window.examTimer = this.timerInterval;
    }
    
    updateTimerDisplay() {
        const minutes = Math.floor(this.timeRemaining / 60);
        const seconds = this.timeRemaining % 60;
        const timerDisplay = document.getElementById('timer');
        
        if (timerDisplay) {
            timerDisplay.textContent = 
                String(minutes).padStart(2, '0') + ':' + 
                String(seconds).padStart(2, '0');
            
            // Add warning class when time is low
            if (this.timeRemaining <= 60) {
                timerDisplay.classList.add('timer-warning');
            }
        }
    }
    
    timeUp() {
        clearInterval(this.timerInterval);
        alert('Time is up! Your exam will be submitted automatically.');
        this.submitExam();
    }
    
    submitExam() {
        // Stop timer
        if (this.timerInterval) {
            clearInterval(this.timerInterval);
        }
        
        // Calculate score
        let score = 0;
        this.questions.forEach((question, index) => {
            if (this.answers[index] === question.correct_option) {
                score++;
            }
        });
        
        // Calculate time taken
        const timeTaken = Math.floor((Date.now() - this.examStartTime) / 1000);
        
        // Submit form
        const form = document.createElement('form');
        form.method = 'POST';
        // Get base URL from current location
        const basePath = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/'));
        form.action = basePath + '/result.php';
        
        form.appendChild(this.createHiddenInput('submit_result', '1'));
        form.appendChild(this.createHiddenInput('score', score));
        form.appendChild(this.createHiddenInput('total_questions', this.questions.length));
        form.appendChild(this.createHiddenInput('time_taken', timeTaken));
        form.appendChild(this.createHiddenInput('status', 'completed'));
        
        document.body.appendChild(form);
        form.submit();
    }
    
    createHiddenInput(name, value) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        return input;
    }
    
    escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
}

// Initialize exam when page loads
if (typeof examQuestions !== 'undefined' && typeof examDuration !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            window.examManager = new ExamManager(examQuestions, examDuration);
        });
    } else {
        window.examManager = new ExamManager(examQuestions, examDuration);
    }
}

