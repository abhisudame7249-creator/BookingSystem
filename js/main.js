/**
 * WanderWise India Travel Booking - Client-side Interactive Functionality (INR / ₹)
 */

document.addEventListener('DOMContentLoaded', function () {
  // 1. Mobile Menu Toggle
  const menuToggle = document.getElementById('mobileMenuToggle');
  const navLinks = document.getElementById('navLinks');
  if (menuToggle && navLinks) {
    menuToggle.addEventListener('click', function () {
      navLinks.classList.toggle('active');
    });
  }

  // 2. Package Details - Interactive Plan Selector & Live Price Calculator
  const planCards = document.querySelectorAll('.plan-select-card');
  const planInput = document.getElementById('selectedPlanInput');
  const adultsInput = document.getElementById('adultsCount');
  const childrenInput = document.getElementById('childrenCount');
  const travelDateInput = document.getElementById('travelDate');
  const addonCheckboxes = document.querySelectorAll('.addon-checkbox');

  // Breakdown displays
  const planNameDisplay = document.getElementById('calcPlanName');
  const planRateDisplay = document.getElementById('calcPlanRate');
  const guestsDisplay = document.getElementById('calcGuestsDisplay');
  const baseSubtotalDisplay = document.getElementById('calcBaseSubtotal');
  const addonsSubtotalDisplay = document.getElementById('calcAddonsSubtotal');
  const totalAmountDisplay = document.getElementById('calcTotalAmount');
  const mainBookButton = document.getElementById('submitBookingBtn');

  // Plan Details dynamic specs
  const specHotel = document.getElementById('specHotel');
  const specTransport = document.getElementById('specTransport');
  const specMeals = document.getElementById('specMeals');
  const specGuide = document.getElementById('specGuide');
  const inclusionsList = document.getElementById('dynamicInclusionsList');

  // Global package data object if defined in PHP
  const pkgPlans = window.currentPackagePlans || null;

  function calculatePackageDetailsTotal() {
    if (!pkgPlans) return;

    const selectedKey = planInput ? planInput.value : 'comfort';
    const plan = pkgPlans[selectedKey];
    if (!plan) return;

    const adults = parseInt(adultsInput ? adultsInput.value : 1, 10) || 1;
    const children = parseInt(childrenInput ? childrenInput.value : 0, 10) || 0;

    // Adult full price, Children 50%
    const adultTotal = adults * plan.discount_price;
    const childTotal = children * Math.round(plan.discount_price * 0.5);
    const baseTotal = adultTotal + childTotal;

    // Add-ons calculation
    let addonsTotal = 0;
    addonCheckboxes.forEach((cb) => {
      if (cb.checked) {
        const price = parseFloat(cb.dataset.price) || 0;
        addonsTotal += price * (adults + children);
      }
    });

    const grandTotal = baseTotal + addonsTotal;

    // Update displays with Indian Rupee (₹)
    if (planNameDisplay) planNameDisplay.textContent = plan.name;
    if (planRateDisplay) planRateDisplay.textContent = '₹' + plan.discount_price.toLocaleString('en-IN') + ' / person';
    if (guestsDisplay) guestsDisplay.textContent = adults + ' Adults' + (children > 0 ? ', ' + children + ' Children' : '');
    if (baseSubtotalDisplay) baseSubtotalDisplay.textContent = '₹' + baseTotal.toLocaleString('en-IN');
    if (addonsSubtotalDisplay) addonsSubtotalDisplay.textContent = '₹' + addonsTotal.toLocaleString('en-IN');
    if (totalAmountDisplay) totalAmountDisplay.textContent = '₹' + grandTotal.toLocaleString('en-IN');
    if (mainBookButton) mainBookButton.textContent = 'Book ' + plan.name + ' • ₹' + grandTotal.toLocaleString('en-IN');
  }

  function updatePlanSpecs(planKey) {
    if (!pkgPlans || !pkgPlans[planKey]) return;
    const p = pkgPlans[planKey];

    if (specHotel) specHotel.textContent = p.hotel;
    if (specTransport) specTransport.textContent = p.transport;
    if (specMeals) specMeals.textContent = p.meals;
    if (specGuide) specGuide.textContent = p.guide;

    if (inclusionsList && p.features) {
      inclusionsList.innerHTML = '';
      p.features.forEach((feat) => {
        const li = document.createElement('li');
        li.className = 'plan-feature-item';
        li.innerHTML = '<span class="feature-check">✓</span> <span>' + feat + '</span>';
        inclusionsList.appendChild(li);
      });
    }
  }

  // Handle plan card clicking
  if (planCards.length > 0) {
    planCards.forEach((card) => {
      card.addEventListener('click', function () {
        planCards.forEach((c) => c.classList.remove('active'));
        this.classList.add('active');
        const planKey = this.dataset.plan;
        if (planInput) {
          planInput.value = planKey;
        }
        updatePlanSpecs(planKey);
        calculatePackageDetailsTotal();
      });
    });

    // Listen to input changes
    if (adultsInput) adultsInput.addEventListener('input', calculatePackageDetailsTotal);
    if (childrenInput) childrenInput.addEventListener('input', calculatePackageDetailsTotal);
    addonCheckboxes.forEach((cb) => cb.addEventListener('change', calculatePackageDetailsTotal));

    // Initialize calculation
    calculatePackageDetailsTotal();
  }

  // 3. Checkout Page Total Calculator (booking.php)
  const checkoutPlanPrice = window.checkoutBasePlanPrice || 0;
  const checkoutAddonCheckboxes = document.querySelectorAll('.checkout-addon-cb');
  const checkoutAdultsInput = document.getElementById('checkoutAdults');
  const checkoutChildrenInput = document.getElementById('checkoutChildren');
  const checkoutAddonsTotalElem = document.getElementById('checkoutAddonsTotal');
  const checkoutGrandTotalElem = document.getElementById('checkoutGrandTotal');
  const checkoutFinalAmountInput = document.getElementById('checkoutFinalAmount');

  function calculateCheckoutTotal() {
    if (!checkoutPlanPrice) return;

    const adults = parseInt(checkoutAdultsInput ? checkoutAdultsInput.value : 1, 10) || 1;
    const children = parseInt(checkoutChildrenInput ? checkoutChildrenInput.value : 0, 10) || 0;

    const baseSum = (adults * checkoutPlanPrice) + (children * Math.round(checkoutPlanPrice * 0.5));
    let addonsSum = 0;

    checkoutAddonCheckboxes.forEach((cb) => {
      if (cb.checked) {
        const p = parseFloat(cb.dataset.price) || 0;
        addonsSum += p * (adults + children);
      }
    });

    const finalSum = baseSum + addonsSum;

    if (checkoutAddonsTotalElem) checkoutAddonsTotalElem.textContent = '₹' + addonsSum.toLocaleString('en-IN');
    if (checkoutGrandTotalElem) checkoutGrandTotalElem.textContent = '₹' + finalSum.toLocaleString('en-IN');
    if (checkoutFinalAmountInput) checkoutFinalAmountInput.value = finalSum;
  }

  if (checkoutAddonCheckboxes.length > 0) {
    checkoutAddonCheckboxes.forEach((cb) => cb.addEventListener('change', calculateCheckoutTotal));
    if (checkoutAdultsInput) checkoutAdultsInput.addEventListener('input', calculateCheckoutTotal);
    if (checkoutChildrenInput) checkoutChildrenInput.addEventListener('input', calculateCheckoutTotal);
    calculateCheckoutTotal();
  }

  // 4. Indian Payment Method Tab Selector (UPI, RuPay/Cards, Net Banking, Pay on Arrival)
  const paymentCards = document.querySelectorAll('.payment-method-card');
  const paymentMethodInput = document.getElementById('paymentMethodInput');
  const upiFields = document.getElementById('upiFields');
  const cardFields = document.getElementById('creditCardFields');
  const netbankingFields = document.getElementById('netbankingFields');
  const arrivalFields = document.getElementById('arrivalFields');

  if (paymentCards.length > 0) {
    paymentCards.forEach((card) => {
      card.addEventListener('click', function () {
        paymentCards.forEach((c) => c.classList.remove('active'));
        this.classList.add('active');
        const method = this.dataset.method;
        if (paymentMethodInput) paymentMethodInput.value = method;

        // Toggle subfields
        if (upiFields) upiFields.style.display = method === 'upi' ? 'block' : 'none';
        if (cardFields) cardFields.style.display = method === 'card' ? 'block' : 'none';
        if (netbankingFields) netbankingFields.style.display = method === 'netbanking' ? 'block' : 'none';
        if (arrivalFields) arrivalFields.style.display = method === 'arrival' ? 'block' : 'none';
      });
    });
  }

  // 5. Packages Filter & Search (packages.php)
  const searchInput = document.getElementById('catalogSearch');
  const categoryFilter = document.getElementById('catalogCategory');
  const tierFilter = document.getElementById('catalogTier');
  const priceRange = document.getElementById('catalogPriceRange');
  const priceDisplay = document.getElementById('priceRangeVal');
  const packageCards = document.querySelectorAll('.package-filter-card');
  const noResultsMsg = document.getElementById('noPackagesFound');

  function filterCatalog() {
    if (!packageCards.length) return;

    const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
    const selectedCategory = categoryFilter ? categoryFilter.value.toLowerCase() : 'all';
    const selectedTier = tierFilter ? tierFilter.value.toLowerCase() : 'all';
    const maxBudget = priceRange ? parseInt(priceRange.value, 10) : 100000;

    let visibleCount = 0;

    packageCards.forEach((card) => {
      const title = (card.dataset.title || '').toLowerCase();
      const location = (card.dataset.location || '').toLowerCase();
      const category = (card.dataset.category || '').toLowerCase();
      const minPrice = parseInt(card.dataset.price || 0, 10);

      const matchesSearch = !query || title.includes(query) || location.includes(query);
      const matchesCategory = selectedCategory === 'all' || category.includes(selectedCategory);
      const matchesPrice = minPrice <= maxBudget;

      if (matchesSearch && matchesCategory && matchesPrice) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (noResultsMsg) {
      noResultsMsg.style.display = visibleCount === 0 ? 'block' : 'none';
    }
  }

  if (searchInput) searchInput.addEventListener('input', filterCatalog);
  if (categoryFilter) categoryFilter.addEventListener('change', filterCatalog);
  if (tierFilter) tierFilter.addEventListener('change', filterCatalog);
  if (priceRange) {
    priceRange.addEventListener('input', function () {
      if (priceDisplay) priceDisplay.textContent = '₹' + parseInt(this.value, 10).toLocaleString('en-IN');
      filterCatalog();
    });
  }

  // 6. Photo Gallery Lightbox / Main Image Switcher
  const galleryThumbnails = document.querySelectorAll('.gallery-thumb-item');
  const mainGalleryImage = document.getElementById('mainGalleryImg');

  if (galleryThumbnails.length > 0 && mainGalleryImage) {
    galleryThumbnails.forEach((thumb) => {
      thumb.addEventListener('click', function () {
        const fullSrc = this.getAttribute('data-full') || this.src;
        mainGalleryImage.src = fullSrc;
        galleryThumbnails.forEach((t) => (t.style.opacity = '0.7'));
        this.style.opacity = '1';
      });
    });
  }
});
