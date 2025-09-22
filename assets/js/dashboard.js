document.addEventListener('DOMContentLoaded', function() {
    
    // ========== GREETING DINAMIS ==========
    const greetingElement = document.getElementById('greeting');
    if (greetingElement) {
        const hour = new Date().getHours();
        let greetingText = "Selamat Datang,";
        if (hour < 11) { greetingText = "Selamat Pagi,"; } 
        else if (hour < 15) { greetingText = "Selamat Siang,"; } 
        else if (hour < 19) { greetingText = "Selamat Sore,"; } 
        else { greetingText = "Selamat Malam,"; }
        greetingElement.firstChild.textContent = greetingText + " ";
    }

    // ========== EFEK BACKGROUND SPOTLIGHT ==========
    document.body.addEventListener('mousemove', (e) => {
        document.documentElement.style.setProperty('--glow-x', `${e.clientX}px`);
        document.documentElement.style.setProperty('--glow-y', `${e.clientY}px`);
    });

    // ========== EFEK 3D TILT PADA KARTU ==========
    const tiltCards = document.querySelectorAll('.tilt-card');
    tiltCards.forEach(card => {
        card.addEventListener('mousemove', (e) => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            const rotateX = (y / rect.height) * -8;
            const rotateY = (x / rect.width) * 8;
            card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
        });
    });

    // ========== ANIMASI ON-SCROLL ==========
    const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-left');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    animatedElements.forEach(el => observer.observe(el));

    // ========== MOTIVASI RANDOM ==========
    const motivasiText = document.getElementById('motivasiText');
    const motivasiBtn = document.getElementById('motivasiBtn');
    if (motivasiBtn) {
        const motivasiList = [ "Setiap hari adalah kesempatan baru.", "Jangan takut gagal, takutlah tak mencoba.", "Sukses adalah hasil dari usaha kecil.", "Belajar hari ini untuk masa depan." ];
        motivasiBtn.addEventListener('click', () => {
            motivasiText.textContent = motivasiList[Math.floor(Math.random() * motivasiList.length)];
        });
    }

    // ========== PLAN CAROUSEL (COVERFLOW EFFECT) ==========
    const planTrack = document.getElementById('planTrack');
    if (planTrack) {
        const planCards = Array.from(planTrack.querySelectorAll('.plan-card'));
        const planPrevBtn = document.getElementById('planPrev');
        const planNextBtn = document.getElementById('planNext');
        let positions = planCards.map((_, index) => index);

        const updateCarouselPositions = () => {
            planCards.forEach((card, index) => {
                const posIndex = positions[index];
                card.classList.remove('is-left', 'is-active', 'is-right', 'is-hidden');
                if (posIndex === 0) card.classList.add('is-left');
                else if (posIndex === 1) card.classList.add('is-active');
                else if (posIndex === 2) card.classList.add('is-right');
                else card.classList.add('is-hidden');
            });
        };

        const rotateCarousel = (direction) => {
            if (direction === 'next') positions.push(positions.shift());
            else positions.unshift(positions.pop());
            updateCarouselPositions();
        };

        planNextBtn.addEventListener('click', () => rotateCarousel('next'));
        planPrevBtn.addEventListener('click', () => rotateCarousel('prev'));
        
        const planModal = document.getElementById('planModal');
        const closePlanModal = document.getElementById('closePlanModal');
        const modalPlanTitle = document.getElementById('modalPlanTitle');
        const planActionBtns = document.querySelectorAll('.plan-action-btn');

        planActionBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const parentCard = this.closest('.plan-card');
                if (parentCard.classList.contains('is-active')) {
                    modalPlanTitle.textContent = `Isi Rencana untuk ${parentCard.dataset.planTitle}`;
                    planModal.style.display = 'flex';
                }
            });
        });

        if(closePlanModal) closePlanModal.onclick = () => planModal.style.display = 'none';
        
        updateCarouselPositions();
    }
    
    // ========== MINI KALENDER LIVE ==========
    const generateMiniCalendar = () => {
        const container = document.getElementById('mini-calendar');
        if (!container) return;
        const now = new Date();
        const monthName = now.toLocaleString('id-ID', { month: 'long' });
        const header = `<div class="mc-header">${monthName} ${now.getFullYear()}</div>`;
        let table = '<table><thead><tr>' + ['M', 'S', 'S', 'R', 'K', 'J', 'S'].map(d => `<th>${d}</th>`).join('') + '</tr></thead><tbody>';
        const firstDay = new Date(now.getFullYear(), now.getMonth(), 1).getDay();
        let date = 1;
        for (let i = 0; i < 6; i++) {
            table += '<tr>';
            for (let j = 0; j < 7; j++) {
                if (i === 0 && j < firstDay || date > new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate()) {
                    table += '<td></td>';
                } else {
                    table += `<td><div class="mc-day${date === now.getDate() ? ' mc-today' : ''}">${date++}</div></td>`;
                }
            }
            table += '</tr>';
            if (date > new Date(now.getFullYear(), now.getMonth() + 1, 0).getDate()) break;
        }
        table += '</tbody></table>';
        container.innerHTML = header + table;
    };
    generateMiniCalendar();

    // ========== MODAL TES KEMAMPUANMU ==========
    const startTestBtn = document.getElementById('startTestBtn');
    const testModal = document.getElementById('testModal');
    const closeTestModalBtn = document.getElementById('closeTestModal');
    const testModalSlider = document.getElementById('testModalSlider');
    const sliderDots = document.querySelectorAll('.slider-dot');

    if (startTestBtn) {
        startTestBtn.addEventListener('click', () => {
            testModal.style.display = 'flex';
        });
    }
    if (closeTestModalBtn) {
        closeTestModalBtn.addEventListener('click', () => {
            testModal.style.display = 'none';
        });
    }
    sliderDots.forEach(dot => {
        dot.addEventListener('click', function() {
            const slideToGo = this.dataset.slideTo;
            testModalSlider.style.transform = `translateX(-${slideToGo * 50}%)`;
            sliderDots.forEach(d => d.classList.remove('active'));
            this.classList.add('active');
        });
    });
    const saranFormModal = document.getElementById('saranFormModal');
    if(saranFormModal) {
        saranFormModal.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Terima kasih atas saran Anda!');
            this.querySelector('textarea').value = '';
        });
    }

    // ========== FLASHCARD GAME LOGIC ==========
    const startFlashcardBtn = document.getElementById('start-flashcard-btn');
    const flashcardModal = document.getElementById('flashcardModal');
    if(startFlashcardBtn) {
        const closeFlashcardBtn = document.getElementById('closeFlashcardModal');
        const cardEl = document.getElementById('flashcard');
        const questionEl = document.getElementById('flashcard-question');
        const answerTitleEl = document.getElementById('flashcard-answer-title');
        const answerTextEl = document.getElementById('flashcard-answer-text');
        const answerOptionsEl = document.getElementById('answerOptions');
        const revealBtn = document.getElementById('revealAnswerBtn');
        const nextBtn = document.getElementById('nextQuestionBtn');
        const progressBar = document.getElementById('flashcardProgressBar');
        
        const questions = [
            { q: 'Apa ibukota dari Indonesia?', opts: ['Jakarta', 'Bandung', 'Surabaya', 'Medan'], a: 0, explanation: 'Jakarta adalah pusat pemerintahan dan bisnis Indonesia sejak kemerdekaan.' },
            { q: 'Planet terbesar di tata surya kita adalah...', opts: ['Mars', 'Bumi', 'Jupiter', 'Saturnus'], a: 2, explanation: 'Jupiter adalah raksasa gas dengan massa lebih dari dua kali gabungan semua planet lain.' },
            { q: 'Siapakah penemu bola lampu?', opts: ['Nikola Tesla', 'Albert Einstein', 'Isaac Newton', 'Thomas Edison'], a: 3, explanation: 'Meskipun banyak yang berkontribusi, Thomas Edison secara komersial mempopulerkan bola lampu pijar.' },
            { q: 'Formula kimia untuk air adalah?', opts: ['CO2', 'O2', 'H2O', 'NaCl'], a: 2, explanation: 'Air terdiri dari dua atom Hidrogen (H2) dan satu atom Oksigen (O).' },
            { q: 'Gunung tertinggi di dunia adalah...', opts: ['Gunung Fuji', 'Gunung Everest', 'Gunung K2', 'Gunung Kilimanjaro'], a: 1, explanation: 'Gunung Everest, yang terletak di pegunungan Himalaya, adalah puncak tertinggi di atas permukaan laut.' }
        ];

        let currentQuestionIndex = 0;
        let isAnswered = false;

        const startGame = () => {
            currentQuestionIndex = 0;
            questions.sort(() => Math.random() - 0.5);
            loadQuestion();
            flashcardModal.style.display = 'flex';
        };

        const loadQuestion = () => {
            isAnswered = false;
            cardEl.classList.remove('is-flipped', 'correct', 'incorrect');
            answerOptionsEl.innerHTML = '';
            nextBtn.style.display = 'none';
            revealBtn.style.display = 'inline-block';
            const q = questions[currentQuestionIndex];
            questionEl.textContent = q.q;
            answerTitleEl.textContent = `Jawaban: ${q.opts[q.a]}`;
            answerTextEl.textContent = q.explanation;
            q.opts.forEach((opt, index) => {
                const btn = document.createElement('button');
                btn.textContent = opt;
                btn.classList.add('answer-btn');
                btn.addEventListener('click', () => checkAnswer(index, q.a));
                answerOptionsEl.appendChild(btn);
            });
            progressBar.style.width = `${((currentQuestionIndex + 1) / questions.length) * 100}%`;
        };

        const checkAnswer = (selectedIndex, correctIndex) => {
            if (isAnswered) return;
            isAnswered = true;
            const answerButtons = answerOptionsEl.querySelectorAll('.answer-btn');
            answerButtons.forEach(btn => btn.disabled = true);
            if (selectedIndex === correctIndex) {
                cardEl.classList.add('correct');
                answerButtons[selectedIndex].classList.add('correct');
            } else {
                cardEl.classList.add('incorrect');
                answerButtons[selectedIndex].classList.add('incorrect');
                answerButtons[correctIndex].classList.add('correct');
            }
            revealBtn.style.display = 'none';
            nextBtn.style.display = 'inline-block';
        };

        const goToNextQuestion = () => {
            currentQuestionIndex++;
            if (currentQuestionIndex < questions.length) {
                cardEl.classList.add('flip-out');
                setTimeout(() => {
                    cardEl.classList.remove('flip-out');
                    loadQuestion();
                    cardEl.classList.add('flip-in');
                    setTimeout(() => cardEl.classList.remove('flip-in'), 500);
                }, 500);
            } else {
                questionEl.textContent = "Selamat, Anda telah menyelesaikan semua pertanyaan!";
                answerOptionsEl.innerHTML = '';
                nextBtn.textContent = 'Main Lagi';
                nextBtn.onclick = () => {
                    nextBtn.textContent = 'Lanjut';
                    startGame();
                };
            }
        };

        startFlashcardBtn.addEventListener('click', startGame);
        closeFlashcardBtn.addEventListener('click', () => flashcardModal.style.display = 'none');
        revealBtn.addEventListener('click', () => cardEl.classList.toggle('is-flipped'));
        nextBtn.addEventListener('click', goToNextQuestion);
    }
    
    // ========== MODAL DETAIL FITUR DINAMIS ==========
    const featureItems = document.querySelectorAll('.feature-item');
    const featureDetailModal = document.getElementById('featureDetailModal');
    if (featureDetailModal) {
        const closeBtn = document.getElementById('closeFeatureDetailModal');
        const modalIconWrapper = document.getElementById('modalFeatureIconWrapper');
        const modalIcon = document.getElementById('modalFeatureIcon');
        const modalTitle = document.getElementById('modalFeatureTitle');
        const modalDesc = document.getElementById('modalFeatureDesc');
        const modalLink = document.getElementById('modalFeatureLink');

        featureItems.forEach(item => {
            item.addEventListener('click', () => {
                const title = item.dataset.title;
                const iconClass = item.dataset.iconClass;
                const iconBg = item.dataset.iconBg;
                const iconColor = item.dataset.iconColor;
                const desc = item.dataset.desc;
                const url = item.dataset.url;

                modalTitle.textContent = title;
                modalDesc.textContent = desc;
                modalIconWrapper.style.backgroundColor = iconBg;
                modalIcon.className = `bi ${iconClass}`;
                modalIcon.style.color = iconColor;
                modalLink.href = url;
                
                featureDetailModal.style.display = 'flex';
            });
        });

        closeBtn.addEventListener('click', () => {
            featureDetailModal.style.display = 'none';
        });
    }

    // ========== MODAL GLOBAL CLOSE HANDLER ==========
    window.addEventListener('click', e => { 
        if (e.target.classList.contains('modal')) {
            e.target.style.display = 'none';
        }
    });
});