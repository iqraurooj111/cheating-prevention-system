/**
 * Cheating Detection Module
 * Monitors tab switches, window blur, and fullscreen exits
 */

class CheatingDetector {
    constructor() {
        this.cheatingDetected = false;
        this.init();
    }
    
    init() {
        // Check if we're on exam page (works with any path structure)
        const pathname = window.location.pathname;
        if (!pathname.includes('exam.php')) {
            return;
        }
        
        // Event listeners for cheating detection
        this.setupEventListeners();
        
        // Check fullscreen status on load
        this.checkFullscreen();
        
        // Continuous monitoring for fullscreen (in case it's exited immediately)
        setInterval(() => {
            if (!this.cheatingDetected) {
                this.checkFullscreen();
            }
        }, 500); // Check every 500ms
    }
    
    setupEventListeners() {
        // Tab switch / Window blur detection
        document.addEventListener('visibilitychange', () => {
            if (document.hidden && !this.cheatingDetected) {
                this.detectCheating('Tab switch or window blur detected');
            }
        });
        
        // Window blur detection (additional check) - detects when window loses focus
        window.addEventListener('blur', () => {
            if (!this.cheatingDetected) {
                // Immediate detection on blur
                this.detectCheating('Window blur detected');
            }
        });
        
        // Window focus detection - also check when window regains focus (might have switched)
        window.addEventListener('focus', () => {
            // Small delay to check if they switched tabs/windows
            setTimeout(() => {
                if (!this.cheatingDetected && document.hidden) {
                    this.detectCheating('Tab switch detected on focus');
                }
            }, 100);
        });
        
        // Additional check: Monitor if document becomes hidden while in exam
        // This catches cases where window is side-by-side but tab is switched
        let lastVisibilityState = document.visibilityState;
        setInterval(() => {
            if (!this.cheatingDetected) {
                const currentVisibility = document.visibilityState;
                if (currentVisibility === 'hidden' && lastVisibilityState === 'visible') {
                    this.detectCheating('Tab visibility changed - possible tab switch');
                }
                lastVisibilityState = currentVisibility;
            }
        }, 200); // Check every 200ms
        
        // Fullscreen exit detection
        document.addEventListener('fullscreenchange', () => {
            this.checkFullscreen();
        });
        
        document.addEventListener('webkitfullscreenchange', () => {
            this.checkFullscreen();
        });
        
        document.addEventListener('mozfullscreenchange', () => {
            this.checkFullscreen();
        });
        
        document.addEventListener('MSFullscreenChange', () => {
            this.checkFullscreen();
        });
        
        // Prevent context menu (right-click)
        document.addEventListener('contextmenu', (e) => {
            e.preventDefault();
        });
        
        // Prevent common keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            // Prevent F12, Ctrl+Shift+I, Ctrl+Shift+J, Ctrl+U
            if (e.key === 'F12' || 
                (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J')) ||
                (e.ctrlKey && e.key === 'u')) {
                e.preventDefault();
                this.detectCheating('Developer tools access attempted');
            }
        });
    }
    
    checkFullscreen() {
        const isFullscreen = !!(
            document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement
        );
        
        if (!isFullscreen && !this.cheatingDetected) {
            this.detectCheating('Fullscreen exit detected');
        }
    }
    
    detectCheating(reason) {
        if (this.cheatingDetected) {
            return; // Already detected, prevent multiple triggers
        }
        
        this.cheatingDetected = true;
        
        console.warn('Cheating detected:', reason);
        
        // Stop exam timer
        if (window.examTimer) {
            clearInterval(window.examTimer);
        }
        
        // Submit exam with cheated status
        this.submitExamAsCheated();
        
        // Show cheating modal
        this.showCheatingModal();
    }
    
    submitExamAsCheated() {
        // Get current answers and time
        const answers = window.examAnswers || {};
        const timeTaken = window.examStartTime ? Math.floor((Date.now() - window.examStartTime) / 1000) : 0;
        
        // Calculate score (0 for cheated)
        const score = 0;
        const totalQuestions = window.examQuestions ? window.examQuestions.length : 0;
        
        // Submit via form
        const form = document.createElement('form');
        form.method = 'POST';
        // Get base URL from current location
        const basePath = window.location.pathname.substring(0, window.location.pathname.lastIndexOf('/'));
        form.action = basePath + '/result.php';
        
        form.appendChild(this.createHiddenInput('submit_result', '1'));
        form.appendChild(this.createHiddenInput('score', score));
        form.appendChild(this.createHiddenInput('total_questions', totalQuestions));
        form.appendChild(this.createHiddenInput('time_taken', timeTaken));
        form.appendChild(this.createHiddenInput('status', 'cheated'));
        
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
    
    showCheatingModal() {
        const modal = document.getElementById('cheatingModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }
}

// Initialize cheating detector when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        window.cheatingDetector = new CheatingDetector();
    });
} else {
    window.cheatingDetector = new CheatingDetector();
}

