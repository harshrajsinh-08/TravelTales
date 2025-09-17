// Yeh locations ka array hai
const locations = [
  {
    name: "Jaipur",
    lat: 26.9124,
    lng: 75.7873,
    description:
      "The Pink City of India, Jaipur is famous for its royal palaces, vibrant bazaars, and historic forts.",
    image:
      "https://images.unsplash.com/photo-1602643163983-ed0babc39797?q=80&w=2865&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Delhi",
    lat: 28.7041,
    lng: 77.1025,
    description:
      "India's capital, Delhi, is a blend of history and modernity with famous landmarks like India Gate and Red Fort.",
    image:
      "https://plus.unsplash.com/premium_photo-1697730320983-f99aab252a44?q=80&w=2667&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Goa",
    lat: 15.2993,
    lng: 74.124,
    description:
      "Known for its beaches, nightlife, and Portuguese heritage, Goa is a paradise for travelers.",
    image:
      "https://images.unsplash.com/photo-1607577070449-531c2296916c?q=80&w=2825&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Mumbai",
    lat: 19.076,
    lng: 72.8777,
    description:
      "The city of dreams, Mumbai offers a vibrant mix of culture, entertainment, and colonial architecture.",
    image:
      "https://images.unsplash.com/photo-1529253355930-ddbe423a2ac7?q=80&w=2865&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Agra",
    lat: 27.1767,
    lng: 78.0081,
    description:
      "Home to the iconic Taj Mahal, Agra showcases the finest Mughal architecture and rich history.",
    image:
      "https://images.unsplash.com/photo-1564507592333-c60657eea523?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Varanasi",
    lat: 25.3176,
    lng: 82.9739,
    description:
      "One of the world's oldest living cities, Varanasi is a spiritual hub with its sacred Ganges ghats.",
    image:
      "https://images.unsplash.com/photo-1561361513-2d000a50f0dc?q=80&w=2776&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Udaipur",
    lat: 24.5854,
    lng: 73.7125,
    description:
      "The City of Lakes, Udaipur is known for its romantic setting, luxury palaces, and beautiful lakes.",
    image:
      "https://images.unsplash.com/photo-1598890777032-bde835ba27c2?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Kochi",
    lat: 9.9312,
    lng: 76.2673,
    description:
      "A coastal gem in Kerala, Kochi features Chinese fishing nets, colonial architecture, and vibrant art scene.",
    image:
      "https://images.unsplash.com/photo-1590123717647-ee0cfe88403d?q=80&w=2942&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Rishikesh",
    lat: 30.0869,
    lng: 78.2676,
    description:
      "The yoga capital of the world, Rishikesh offers spiritual experiences, adventure sports, and serene Ganges views.",
    image:
      "https://images.unsplash.com/photo-1591099112017-7c7be4b63465?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Amritsar",
    lat: 31.634,
    lng: 74.8723,
    description:
      "Home to the Golden Temple, Amritsar is the spiritual center of the Sikh faith and famous for its cuisine.",
    image:
      "https://images.unsplash.com/photo-1588096344356-9b047c9471dc?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
  },
  {
    name: "Mysore Palace",
    lat: 12.3052,
    lng: 76.6552,
    description: "Witness the grandeur of India's royal heritage at Mysore Palace.",
    image: "https://images.unsplash.com/photo-1595672115071-12b30f76aa5d?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Sun Temple, Konark",
    lat: 19.8876,
    lng: 86.0945,
    description: "Explore the ancient marvel dedicated to the Sun God at Konark.",
    image: "https://images.unsplash.com/photo-1609156304645-62f07fd35a1a?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Andaman & Nicobar Islands",
    lat: 11.7401,
    lng: 92.6586,
    description: "Discover pristine beaches and crystal-clear waters in the Andaman Islands.",
    image: "https://images.unsplash.com/photo-1604877150352-99bfc60aebf7?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Meghalaya’s Living Root Bridges",
    lat: 25.1511,
    lng: 91.6122,
    description: "A natural wonder shaped by generations in Meghalaya’s rainforests.",
    image: "https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Golden Temple, Amritsar",
    lat: 31.634,
    lng: 74.8723,
    description: "Experience serenity at the holiest Sikh shrine, the Golden Temple in Amritsar.",
    image: "https://images.unsplash.com/photo-1595341860411-5a9c0d82d204?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Ajanta and Ellora Caves",
    lat: 20.547,
    lng: 75.7036,
    description: "Marvel at the ancient rock-cut caves and intricate sculptures.",
    image: "https://images.unsplash.com/photo-1564507592333-c60657eea523?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Hampi",
    lat: 15.335,
    lng: 76.4619,
    description: "Explore the ruins of the Vijayanagara Empire in this UNESCO World Heritage Site.",
    image: "https://images.unsplash.com/photo-1564507592333-c60657eea523?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Khajuraho Temples",
    lat: 24.834,
    lng: 79.9192,
    description: "Famous for their intricate erotic sculptures, these temples are a UNESCO World Heritage Site.",
    image: "https://images.unsplash.com/photo-1564507592333-c60657eea523?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},
{
    name: "Ranthambore National Park",
    lat: 26.0026,
    lng: 76.6349,
    description: "A wildlife sanctuary known for its Bengal tigers and diverse flora and fauna.",
    image: "https://images.unsplash.com/photo-1564507592333-c60657eea523?q=80&w=2874&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
},


];
// Map ko initialize kar rahe hain
const map = L.map("map").setView([20.5937, 78.9629], 5);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  maxZoom: 19,
  attribution: "© OpenStreetMap",
}).addTo(map);

// Markers ko store karne ke liye object hai
const markers = {};
// Location ki details dikhane ka function hai
function displayLocationDetails(location) {
  Object.values(markers).forEach((marker) => map.removeLayer(marker));
  const marker = L.marker([location.lat, location.lng])
    .addTo(map)
    .bindTooltip(location.name)
    .openTooltip();

  markers[location.name] = marker;
  map.setView([location.lat, location.lng], 8);
  const card = document.getElementById("location-card");
  card.innerHTML = `
    <img src="${location.image}" alt="${location.name}" class="h-48 w-full object-cover rounded-t-xl">
    <div class="p-4">
      <h3 class="text-2xl font-bold mb-2">${location.name}</h3>
      <p class="text-gray-600">${location.description}</p>
    </div>
  `;
  card.classList.remove("hidden");
}


// Search ka logic hai
const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("searchResults");

// Jab user search box mein type karta hai
searchInput.addEventListener("input", function (e) {
  const searchTerm = e.target.value.toLowerCase();

  if (searchTerm.length < 1) {
    searchResults.classList.add("hidden");
    return;
  }

  const filteredLocations = locations.filter((location) =>
    location.name.toLowerCase().includes(searchTerm)
  );

  if (filteredLocations.length > 0) {
    searchResults.innerHTML = filteredLocations
      .map(
        (location) => `
          <div class="p-3 hover:bg-gray-100 cursor-pointer text-gray-800"
               onclick="selectLocation('${location.name}')">
            ${location.name}
          </div>
        `
      )
      .join("");
    searchResults.classList.remove("hidden");
  } else {
    searchResults.classList.add("hidden");
  }
});

// Location select karne par yeh function chalega
function selectLocation(locationName) {
  const location = locations.find((loc) => loc.name === locationName);
  if (location) {
    searchInput.value = location.name;
    searchResults.classList.add("hidden");
    displayLocationDetails(location);

    // Scroll to map
    document.getElementById("plan-trip").scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  }
}

// Search button dabane par yeh function chalega
function handleSearch() {
  const searchTerm = searchInput.value.trim();
  const location = locations.find(
    (loc) => loc.name.toLowerCase() === searchTerm.toLowerCase()
  );
  if (location) {
    displayLocationDetails(location);
    document.getElementById("plan-trip").scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  } else {
    alert("Please select a location from the list");
  }
}

// Map par click karne par kya hoga
map.on("click", function (e) {
  const { lat, lng } = e.latlng;

  const location = locations.find(
    (loc) => Math.abs(loc.lat - lat) < 1 && Math.abs(loc.lng - lng) < 1
  );

  if (location) {
    displayLocationDetails(location);
    searchInput.value = location.name;
  } else {
    alert("No predefined location found near this point. Please try another spot!");
  }
});

// Bahar click karne par dropdown band ho jayega
document.addEventListener("click", function (e) {
  if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
    searchResults.classList.add("hidden");
  }
});