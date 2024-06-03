document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('data');
    const timeSelect = document.getElementById('ora');

    dateInput.addEventListener('change', function() {
        const selectedDate = this.value;
        fetch(`get_available_times.php?date=${selectedDate}`)
            .then(response => response.json())
            .then(data => {
                timeSelect.innerHTML = '';
                data.times.forEach(time => {
                    const option = document.createElement('option');
                    option.value = time;
                    option.textContent = time;
                    timeSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    });

    
    const currentDate = new Date().toISOString().slice(0, 10);
    dateInput.value = currentDate;
    dateInput.dispatchEvent(new Event('change'));
});
