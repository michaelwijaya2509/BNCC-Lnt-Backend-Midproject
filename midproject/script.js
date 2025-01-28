function generateRandomId() {
    return Math.floor(Math.random() * 100000 + 1); // Generate ID antara 0 dan 99999
}

function setRandomId() {
    const randomId = generateRandomId();
    console.log("Generated ID:", randomId); 
    document.getElementById('userId').value = randomId;
}