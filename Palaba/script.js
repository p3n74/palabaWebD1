document.addEventListener('DOMContentLoaded', () => {
    const openPopupButton = document.getElementById('openPopupButton');
    const popupOverlay = document.getElementById('popupOverlay');
    const closePopup = document.getElementById('closePopup');

    openPopupButton.addEventListener('click', () => {
        popupOverlay.style.display = 'flex'; // Show the popup
    });

    closePopup.addEventListener('click', () => {
        popupOverlay.style.display = 'none'; // Hide the popup
    });

    // Close the popup when clicking outside the popup content
    window.addEventListener('click', (event) => {
        if (event.target === popupOverlay) {
            popupOverlay.style.display = 'none';
        }
    });
});