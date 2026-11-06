
document.addEventListener('DOMContentLoaded', function () {
    const button = document.getElementById('lookup');
    const citiesButton = document.getElementById('lookup-cities');
    const country = document.getElementById('country');
    const result = document.getElementById('result');

    button.addEventListener('click', function () {
        const countryName = country.value;

        fetch('world.php?country=' + encodeURIComponent(countryName))
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                result.textContent = 'An error occurred while retrieving data.';
                console.error(error);
            });
    });

    citiesButton.addEventListener('click', function () {
        const countryName = country.value;

        fetch('world.php?country=' + encodeURIComponent(countryName) + '&lookup=cities')
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                result.textContent = 'An error occurred while retrieving data.';
                console.error(error);
            });
    });
});
