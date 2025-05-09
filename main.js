import productsData from "./productos.js";

const productListContainer = document.getElementById("product-container"); // para random
const fullListContainer = document.getElementById("productsContainer"); // para la lista completa
const checkboxes = document.querySelectorAll(".filters input[type='checkbox']");
const searchInput = document.getElementById("searchInput");

// Variables de estado
let currentPage = 1;
const productsPerPage = 6;

function renderProducts(arr) {
  if (!fullListContainer) return;

  // Calcular productos a mostrar
  const startIndex = (currentPage - 1) * productsPerPage;
  const endIndex = startIndex + productsPerPage;
  const productsToShow = arr.slice(0, endIndex);

  // Renderizar productos
  fullListContainer.innerHTML = productsToShow
    .map(
      (p) => `
      <div class="product-card" style="max-width: 250px;">
        <img src="${p.img}" alt="${p.name}" />
        <h3>${p.name}</h3>
        <p>${p.storage}</p>
      </div>
    `
    )
    .join("");

  // Agregar botón "Ver más" si hay más productos
  if (arr.length > endIndex) {
    const loadMoreButton = document.createElement("button");
    loadMoreButton.className = "btn-cta";
    loadMoreButton.textContent = "Ver más";
    loadMoreButton.style.gridColumn = "1 / -1"; // Ocupa todas las columnas
    loadMoreButton.style.justifySelf = "center"; // Centra horizontalmente
    loadMoreButton.style.margin = "20px 0";
    loadMoreButton.style.whiteSpace = 'nowrap';
    loadMoreButton.addEventListener("click", () => {
      currentPage++;
      renderProducts(arr);
    });

    fullListContainer.appendChild(loadMoreButton);
  }
}

function filterProducts() {
  const selected = Array.from(checkboxes)
    .filter((cb) => cb.checked)
    .map((cb) => cb.value);

  const search = searchInput.value.toLowerCase();

  const filtered = productsData.filter((p) => {
    const matchesFilter = selected.length
      ? selected.includes(p.category)
      : true;
    const matchesSearch = p.name.toLowerCase().includes(search);
    return matchesFilter && matchesSearch;
  });

  renderProducts(filtered);
}

if (checkboxes.length) {
  checkboxes.forEach((cb) => cb.addEventListener("change", filterProducts));
  searchInput.addEventListener("input", filterProducts);
}

function renderRandomProducts() {
  if (!productListContainer) return; // solo corre en index.html

  productListContainer.innerHTML = "";

  const shuffled = [...productsData].sort(() => 0.5 - Math.random());
  const selected = shuffled.slice(0, 4);

  selected.forEach((product) => {
    const productCard = document.createElement("div");
    productCard.className = "product-card";

    productCard.innerHTML = `
      <img src="${product.img}" alt="${product.name}" />
      <h3>${product.name}</h3>
      <p>Almacenamiento: ${product.storage}</p>
    `;

    productListContainer.appendChild(productCard);
  });
}

function toggleFilters() {
  const section = document.getElementById("filtersSection");
  if (!section) return;

  const isHidden =
    section.style.display === "none" || section.style.display === "";
  section.style.display = isHidden ? "block" : "none";

  if (isHidden) {
    // Aplicar estilos solo cuando se muestra
    section.style.margin = "10px auto 0 auto"; // centrado horizontal con margen arriba
    section.style.width = "fit-content";
  }
}

function resetFilters() {
  const checkboxes = document.querySelectorAll(
    '#filtersSection input[type="checkbox"]'
  );
  checkboxes.forEach((cb) => (cb.checked = false));
  filterProducts(); // Llama a filterProducts después de resetear para actualizar la lista
}

// Esto hace que toggleFilters y resetFilters estén disponibles globalmente
window.toggleFilters = toggleFilters;
window.resetFilters = resetFilters;

document.addEventListener("DOMContentLoaded", () => {
  if (fullListContainer) {
    renderProducts(productsData); // corre solo en productos.html
  } else if (productListContainer) {
    renderRandomProducts(); // corre solo en index.html
  }
});

document.addEventListener("DOMContentLoaded", () => {
  initBurgerMenu();
});

function initBurgerMenu() {
  const burgerButton = document.querySelector(".burger-menu");
  const navMenu = document.querySelector(".nav");

  if (!burgerButton || !navMenu) return;

  burgerButton.addEventListener("click", () =>
    toggleMenu(burgerButton, navMenu)
  );
  setupNavLinks(burgerButton, navMenu);
}

function toggleMenu(burgerButton, navMenu) {
  const isExpanded = burgerButton.getAttribute("aria-expanded") === "true";
  burgerButton.setAttribute("aria-expanded", !isExpanded);
  navMenu.classList.toggle("active");
}

function setupNavLinks(burgerButton, navMenu) {
  const navLinks = document.querySelectorAll(".nav a");
  navLinks.forEach((link) => {
    link.addEventListener("click", () => closeMenu(burgerButton, navMenu));
  });
}

function closeMenu(burgerButton, navMenu) {
  burgerButton.setAttribute("aria-expanded", "false");
  navMenu.classList.remove("active");
}
