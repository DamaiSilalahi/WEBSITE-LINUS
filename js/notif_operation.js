function showNotification(message) {
    const notificationBox = document.getElementById("notification");
    const notificationMessage = document.getElementById("notificationMessage");

    notificationMessage.textContent = message;
    notificationBox.classList.add("show"); 

    setTimeout(() => {
        notificationBox.classList.remove("show"); 
    }, 5000);
}

function isOperatingHours() {
    const now = new Date();
    const day = now.getDay(); 
    const hours = now.getHours();
    const minutes = now.getMinutes();

    if (day === 0) {
        return false; 
    }

    if (day >= 1 && day <= 4) {
        if ((hours > 7 || (hours === 7 && minutes >= 30)) && hours < 17) {
            return true; 
        }
    }

    if (day === 5) {
        if ((hours > 7 || (hours === 7 && minutes >= 30)) && hours < 11.30) {
            return true; 
        }
        if (hours >= 14 && hours < 17) {
            return true;
        }
    }

    return false; 
}

if (isOperatingHours()) {
    showNotification("Kami sedang beroperasi. Silakan hubungi kami.");
} else {
    showNotification("Kami sedang tidak beroperasi. Silakan hubungi kami selama jam operasional.");
}