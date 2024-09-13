// Target HTML elements with JavaScript
const menu = document.querySelector('#mobile-menu');
const menuLinks = document.querySelector('.navbar__menu');
const serviceList = document.querySelector('#service-list ul');
const serviceDetails = document.querySelector('#service__details');
const imageDiv = document.querySelector('#service-image'); // This is the service image
const priceDiv = document.querySelector('#service-price');
const availableSessionSlotsDiv = document.querySelector('#available-session-slots');
const bookNowBtn = document.querySelector('#book-now');

imageDiv.style.height = "400px";
imageDiv.style.width = "400px";

// Display Mobile Menu
const mobileMenu = () => {
    menu.classList.toggle('is-active');
    menuLinks.classList.toggle('active');
};

// Add an event listener to toggle the two classes
menu.addEventListener('click', mobileMenu);

// Search bar function
function search_service() {
    let input = document.getElementById('searchbar').value.toLowerCase();
    let services = document.querySelectorAll('#service-list li');

    services.forEach(service => {
        if (service.innerText.toLowerCase().includes(input)) {
            service.style.display = "list-item";
        } else {
            service.style.display = "none";
        }
    });
}

// Render a single service
function renderOneService(service) {
    let listItem = document.createElement('li');
    let remainingSlots = service.session_slots - service.booked_slots;
    listItem.innerText = service.service_name;

    listItem.addEventListener('click', () => {
        // Display service details
        imageDiv.src = service.image;
        priceDiv.textContent = `Service Price: ${service.price}`;
        availableSessionSlotsDiv.textContent = `Available Session Slots: ${remainingSlots}`;

        // Event listener for book now button clicks
        bookNowBtn.addEventListener("click", (e) => {
            e.preventDefault();
            if (updateAvailableSlots(service, 1)) {
                service.booked_slots += 1;
                const outputMessage = document.createElement("p");
                outputMessage.textContent = "You have secured a slot";
                availableSessionSlotsDiv.appendChild(outputMessage);
            } else {
                availableSessionSlotsDiv.textContent = `All sessions booked!`;
            }
        });
    });

    serviceList.appendChild(listItem);
}

// Fetch all services
function getAllServices() {
    fetch('http://localhost:3000/services')
        .then(res => res.json())
        .then(services => services.forEach(service => renderOneService(service)));
}

// Fetch a specific service
function getFirstService() {
    fetch('http://localhost:3000/services/1')
        .then(res => res.json())
        .then(service => renderOneService(service));
}

// Initialize render - load and render services to the DOM
function initialize() {
    getAllServices();
}

// Function to update available slots
function updateAvailableSlots(service, slotsBooked) {
    const remainingSlots = service.session_slots - service.booked_slots;
    const newRemainingSlots = remainingSlots - slotsBooked;
    if (newRemainingSlots < 1) {
        return false;
    }
    availableSessionSlotsDiv.textContent = `Available Session Slots: ${newRemainingSlots}`;
    return true;
}

// Add a new service
function addService(service) {
    fetch('http://localhost:3000/services', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(service)
    })
    .then(response => response.json())
    .then(service => {
        renderOneService(service);
        form.reset(); // Reset the form
    })
    .catch(error => console.error('Error:', error));
}

// Form submission for adding a new service
let form = document.querySelector("form");
form.addEventListener('submit', (e) => {
    e.preventDefault();
    let service = {
        service_name: document.getElementById("service").value,
        image: document.getElementById("image-url").value,
        session_slots: document.getElementById("session-slots").value,
        booked_slots: document.getElementById("booked-slots").value,
        price: document.getElementById("session-price").value
    };
    addService(service);
});

// Initialize on page load
document.addEventListener('DOMContentLoaded', initialize);
