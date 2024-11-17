
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

  <div class="container mt-5">
    <h1 class="text-center">Plant Products</h1>

    <!-- Search Box -->
    <div class="mb-4">
      <input type="text" id="search-box" class="form-control" placeholder="Search by product name..." onkeyup="applyFilters()">
    </div>

    <!-- Toggle Filters Button for Mobile -->
    <div class="mb-3 text-end d-md-none">
      <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#filters-collapse" aria-expanded="false" aria-controls="filters-collapse">
        Toggle Filters
      </button>
    </div>

    <!-- Filters Section (Always Visible on Desktop, Toggleable on Mobile) -->
    <div class="mb-4 row">
      <!-- Filters visible on large screens only -->
      <div class="mb-2 col-12 col-md-3 d-none d-md-block">
        <select id="light-filter" class="form-select" onchange="applyFilters()">
          <option value="">Light</option>
          <option value="Partial Sun">Partial Sun</option>
          <option value="Full Sun">Full Sun</option>
          <option value="Shade">Shade</option>
        </select>
      </div>
      
      <div class="mb-2 col-12 col-md-3 d-none d-md-block">
        <select id="water-filter" class="form-select" onchange="applyFilters()">
          <option value="">Water</option>
          <option value="Low">Low</option>
          <option value="Medium">Medium</option>
          <option value="High">High</option>
        </select>
      </div>
      
      <div class="mb-2 col-12 col-md-3 d-none d-md-block">
        <select id="growth-filter" class="form-select" onchange="applyFilters()">
          <option value="">Growth</option>
          <option value="Fast">Fast</option>
          <option value="Medium">Medium</option>
          <option value="Slow">Slow</option>
        </select>
      </div>
      
      <div class="mb-2 col-12 col-md-3 d-none d-md-block">
        <select id="pet-filter" class="form-select" onchange="applyFilters()">
          <option value="">Pet Friendly</option>
          <option value="Yes">Yes</option>
          <option value="No">No</option>
        </select>
      </div>

      <!-- Filters Collapse on Mobile -->
      <div class="mb-4 collapse d-md-none" id="filters-collapse">
        <div class="mb-2 col-12">
          <select id="light-filter-mobile" class="form-select" onchange="applyFilters()">
            <option value="">Light</option>
            <option value="Partial Sun">Partial Sun</option>
            <option value="Full Sun">Full Sun</option>
            <option value="Shade">Shade</option>
          </select>
        </div>
        <div class="mb-2 col-12">
          <select id="water-filter-mobile" class="form-select" onchange="applyFilters()">
            <option value="">Water</option>
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select>
        </div>
        <div class="mb-2 col-12">
          <select id="growth-filter-mobile" class="form-select" onchange="applyFilters()">
            <option value="">Growth</option>
            <option value="Fast">Fast</option>
            <option value="Medium">Medium</option>
            <option value="Slow">Slow</option>
          </select>
        </div>
        <div class="mb-2 col-12">
          <select id="pet-filter-mobile" class="form-select" onchange="applyFilters()">
            <option value="">Pet Friendly</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Clear Filters Button -->
    <div class="mb-4 text-center">
      <button id="clear-filters" class="btn btn-danger" onclick="clearFilters()">Clear Filters</button>
    </div>

    <!-- Products Section -->
    <div class="row" id="products-section">
      <!-- Dynamic content will appear here -->
    </div>

    <!-- Load More Button -->
    <div class="mt-4 text-center">
      <button id="load-more-btn" class="btn btn-success" onclick="loadMore()">Load More</button>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    const apiUrl = "http://127.0.0.1:8000/products"; // Local endpoint
    const imageBaseUrl = "http://127.0.0.1:8000/assets/images/"; // Local image path if needed

    let allProducts = []; // To store all products
    let displayedProducts = 30; // Initial number of products to display

    // Function to fetch and display products
    async function loadProducts() {
      try {
        const response = await fetch(apiUrl);
        
        if (!response.ok) {
          throw new Error(`Failed to fetch products: ${response.status}`);
        }

        const data = await response.json();
        console.log('Fetched data:', data); // Log fetched data to debug

        if (data.products && Array.isArray(data.products)) {
          allProducts = data.products;
          displayProducts(allProducts.slice(0, displayedProducts)); // Display initial set of products
        } else {
          throw new Error('Expected "products" array, but got something else.');
        }
      } catch (error) {
        console.error("Error loading products:", error);
      }
    }

    // Function to display products
    function displayProducts(products) {
      const productsSection = document.getElementById("products-section");
      productsSection.innerHTML = ""; // Clear existing content

      if (products.length === 0) {
        productsSection.innerHTML = "<p>No products match your filters.</p>";
        return;
      }

      products.forEach(product => {
        const productCard = document.createElement("div");
        productCard.classList.add("col-6", "col-md-4", "col-lg-3", "mb-4");
        productCard.innerHTML = `
          <div class="card">
            <img src="${imageBaseUrl}${product.image}" class="card-img-top" alt="${product.name}">
            <div class="card-body">
              <h5 class="card-title">${product.name}</h5>
              <p class="card-text">${product.description.replace(/<[^>]*>/g, '').slice(0, 100)}...</p>
              <p class="price fw-bold text-success">KSH ${product.price}</p>
              <p class="text-muted">Availability: ${product.available}</p>
              <form action="/menu/${product.id}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
              </form>
            </div>
          </div>
        `;
        productsSection.appendChild(productCard);
      });
    }

    // Function to apply filters and search
    function applyFilters() {
      const lightFilter = document.getElementById("light-filter").value || document.getElementById("light-filter-mobile").value;
      const waterFilter = document.getElementById("water-filter").value || document.getElementById("water-filter-mobile").value;
      const growthFilter = document.getElementById("growth-filter").value || document.getElementById("growth-filter-mobile").value;
      const petFilter = document.getElementById("pet-filter").value || document.getElementById("pet-filter-mobile").value;
      const searchQuery = document.getElementById("search-box").value.toLowerCase();

      const filteredProducts = allProducts.filter(product => {
        const matchesLight = lightFilter === "" || product.light === lightFilter;
        const matchesWater = waterFilter === "" || product.water === waterFilter;
        const matchesGrowth = growthFilter === "" || product.growth === growthFilter;
        const matchesPet = petFilter === "" || product.petFriendly === petFilter;
        const matchesSearch = product.name.toLowerCase().includes(searchQuery);

        return matchesLight && matchesWater && matchesGrowth && matchesPet && matchesSearch;
      });

      displayProducts(filteredProducts.slice(0, displayedProducts)); // Display filtered products
    }

    // Function to clear all filters
    function clearFilters() {
      document.getElementById("light-filter").value = "";
      document.getElementById("water-filter").value = "";
      document.getElementById("growth-filter").value = "";
      document.getElementById("pet-filter").value = "";
      document.getElementById("light-filter-mobile").value = "";
      document.getElementById("water-filter-mobile").value = "";
      document.getElementById("growth-filter-mobile").value = "";
      document.getElementById("pet-filter-mobile").value = "";
      document.getElementById("search-box").value = "";

      applyFilters(); // Reapply filters to reset the view
    }

    // Load more products
    function loadMore() {
      displayedProducts += 30;
      displayProducts(allProducts.slice(0, displayedProducts));
    }

    // Call loadProducts on page load
    loadProducts();
  </script>

