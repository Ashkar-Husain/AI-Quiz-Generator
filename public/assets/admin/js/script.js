function switchTab(btn, text) {

    // Remove active from all buttons
    document.querySelectorAll('.tab-btn')
        .forEach(button => button.classList.remove('active'));

    // Add active to clicked button
    btn.classList.add('active');

    // Hide all cards
    document.querySelectorAll('.card')
        .forEach(card => card.classList.remove('active'));

    // Show selected card
    const targetCard = document.querySelector('.card.' + text);

    if (targetCard) {
        targetCard.classList.add('active');
    }

    // Save selected tab
    localStorage.setItem('activeTab', text);
}


// On Page Load
document.addEventListener("DOMContentLoaded", function () {

    let savedTab = localStorage.getItem('activeTab') || 'manual';

    let activeButton = document.querySelector(`.tab-btn[onclick*="${savedTab}"]`);
    let activeCard = document.querySelector('.card.' + savedTab);

    if (activeButton && activeCard) {

        document.querySelectorAll('.tab-btn')
            .forEach(button => button.classList.remove('active'));

        document.querySelectorAll('.card')
            .forEach(card => card.classList.remove('active'));

        activeButton.classList.add('active');
        activeCard.classList.add('active');
    }
});


//* Excel Card
document.addEventListener("DOMContentLoaded", function () {

    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const fileText = document.querySelector('.file-text');

    function uploadFile() {
        if (!dropZone.classList.contains('uploading')) {
            dropZone.classList.add('uploading');
            dropZone.submit();
        }
    }

    // ================= FILE SELECT =================
    fileInput.addEventListener('change', function (e) {

        const file = e.target.files[0];

        if (file) {
            fileText.textContent = file.name;
            uploadFile();
        }
    });

    // ================= DRAG EVENTS =================
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('dragover');
        });
    });

    // ================= DROP UPLOAD =================
    dropZone.addEventListener('drop', function (e) {

        const file = e.dataTransfer.files[0];

        if (file) {
            fileInput.files = e.dataTransfer.files;
            fileText.textContent = file.name;
            uploadFile();
        }
    });

});

