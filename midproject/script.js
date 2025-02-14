//generate random id
function generateRandomId() {
    return Math.floor(Math.random() * 100000 + 1); 
}

function setRandomId() {
    const randomId = generateRandomId();
    console.log("Generated ID:", randomId); 
    document.getElementById('userId').value = randomId;
}

// Pastikan script berjalan setelah halaman termuat
document.addEventListener("DOMContentLoaded", setRandomId);