document.addEventListener('DOMContentLoaded', function() {
    const formGroups = document.querySelectorAll('.form-group');
    const form = document.getElementById('registrationForm');
    const notification = document.getElementById('notification');

    // Animasi scroll
    function checkScroll() {
        formGroups.forEach(group => {
            const rect = group.getBoundingClientRect();
            if (rect.top <= window.innerHeight * 0.75) {
                group.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', checkScroll);
    checkScroll(); // Check on page load

    // Validasi dan pengiriman form
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi checkbox
        const checkboxes = document.querySelectorAll('input[name="robot[]"]:checked');
        if (checkboxes.length === 0) {
            alert('Pilih setidaknya satu jenis robot yang ingin dibuat.');
            return;
        }
        
        // Kirim data form
        const formData = new FormData(form);
        
        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.style.display = 'none';
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Terjadi kesalahan. Silakan coba lagi.', 'error');
        });
    });

    function showNotification(message, type) {
        notification.textContent = message;
        notification.className = type;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 5000);
    }
});
