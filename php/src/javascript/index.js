function togglePlayer2Options() {
    const isIA = document.querySelector('input[name="player2_type"]:checked').value === 'ia';
    document.getElementById('player2_options').style.display = isIA ? 'none' : 'block';

    if (!isIA) {
        updatePlayer2ColorOptions();
    }
}

function updatePlayer2ColorOptions() {
    const player1Color = document.getElementById('player1_color').value;
    const player2ColorSelect = document.getElementById('player2_color');
    const options = player2ColorSelect.options;

    for (let i = 0; i < options.length; i++) {
        if (options[i].value === player1Color) {
            options[i].disabled = true;  
        } else {
            options[i].disabled = false; 
        }
    }
}

window.onload = function() {
    togglePlayer2Options(); 
    updatePlayer2ColorOptions();
};
