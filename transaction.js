const CART_KEY = "pos_cart";

function getCart() {
  return JSON.parse(localStorage.getItem(CART_KEY)) || [];
}

function saveCart(cart) {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function addToChart(product) {
  let cart = getCart();

  const found = cart.find((item) => item.id === product.id);
  if (found) {
    found.qty += 1;
  } else {
    cart.push({
      ...product,
      qty: 1,
    });
  }
  saveCart(cart);
  renderCart();
}

function updateQty(id, change) {
  let cart = getCart();

  cart = cart.map((item) => {
    if (item.id === id) {
      item.qty = Math.max(1, item.qty + change);
    }
    return item;
  });
  saveCart(cart);
  renderCart();
}

function removeItem(id) {
  const cart = getCart().filter((item) => item.id !== id);
  saveCart(cart);
  renderCart();
}

function formatRupiah(number) {
  return "Rp" + number.toLocaleString("id-ID");
}

function renderCart() {
  const container = document.querySelector("#order-items");
  const template = document.querySelector("#order-item-template");

  container.innerHTML = "";

  const cart = getCart();

  cart.forEach((item) => {
    const clone = template.content.cloneNode(true);

    //set Data:
    const orderItem = clone.querySelector(".order-item");
    orderItem.dataset.id = item.id;

    clone.querySelector(".product-img").src = item.image;
    clone.querySelector(".product-name").textContent = item.name;
    clone.querySelector(".product-price").textContent = formatRupiah(
      item.price,
    );
    clone.querySelector(".qty").textContent = item.qty;
    clone.querySelector(".total-price").textContent = formatRupiah(
      item.price * item.qty,
    );

    //event tombol
    clone.querySelector(".qty-plus").onclick = () => updateQty(item.id, 1);
    clone.querySelector(".qty-minus").onclick = () => updateQty(item.id, -1);
    clone.querySelector(".remove-btn").onclick = () => removeItem(item.id);

    container.appendChild(clone);
  });
  calculateTotal();
}

function calculateTotal() {
  const cart = getCart();
  let subtotal = 0;
  cart.forEach((item) => {
    subtotal += item.price * item.qty;
  });
  const tax = subtotal * 0.12; //pajak 12%
  const discount = subtotal * 0.1; //diskon 10%
  const total = subtotal + tax - discount;

  document.querySelector("#subtotal").textContent = formatRupiah(subtotal);
  document.querySelector("#tax").textContent = formatRupiah(tax);
  document.querySelector("#discount").textContent = formatRupiah(discount);
  document.querySelector("#total-bill").textContent = formatRupiah(total);
}
document.addEventListener("DOMContentLoaded", renderCart);
