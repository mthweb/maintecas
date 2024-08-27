document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById('modal');
    var openModalBtn = document.getElementById('openModalBtn');
    var closeModalBtn = document.getElementsByClassName('close-btn')[0];

    openModalBtn.onclick = function() {
        modal.classList.add('show');
        modal.style.display = 'flex';
    }

    closeModalBtn.onclick = function() {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300); // Match the duration of the transform transition
        modal.classList.add('show');
    }

    window.onclick = function(event) {
        if (event.target === modal) {
            modal.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
            }, 300); // Match the duration of the transform transition
        }
    }
});