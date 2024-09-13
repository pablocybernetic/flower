<style>
/* Other styles remain unchanged */

.section1 {
   margin: 0 auto;
   padding: 6rem 0 1rem;
}

.container1 {
   max-width: 75rem;
   height: auto;
   margin: 0 auto;
   padding: 0 1.25rem;
}

.centered1 {
   text-align: center;
   vertical-align: middle;
   margin-bottom: 1rem;
}

/* Heading styles */
.heading1-xl {
   font-family: inherit;
   font-size: clamp(2.648rem, 6vw, 4.241rem);
   font-weight: 700;
   line-height: 1.15;
   letter-spacing: -1px;
}

.heading1-lg {
   font-family: inherit;
   font-size: clamp(2.179rem, 5vw, 3.176rem);
   font-weight: 700;
   line-height: 1.15;
   letter-spacing: -1px;
}

.heading1-md {
   font-family: inherit;
   font-size: clamp(1.794rem, 4vw, 2.379rem);
   font-weight: 700;
   line-height: 1.25;
   letter-spacing: -1px;
}

.heading1-sm {
   font-family: inherit;
   font-size: clamp(1.476rem, 3vw, 1.782rem);
   font-weight: 600;
   line-height: 1.5;
}

.heading1-xs {
   font-family: inherit;
   font-size: clamp(1.215rem, 2vw, 1.335rem);
   font-weight: 500;
   line-height: 1.5;
}

.paragraph1 {
   font-family: inherit;
   font-size: clamp(1rem, 2vw, 1.125rem);
   text-wrap: balance;
   color: var(--color-white-200);
}

.btn1 {
   display: inline-block;
   font-family: inherit;
   font-size: 1rem;
   font-weight: 500;
   line-height: 1.5;
   text-align: center;
   vertical-align: middle;
   white-space: nowrap;
   user-select: none;
   outline: none;
   border: none;
   border-radius: 0.25rem;
   text-transform: unset;
   transition: all 0.3s ease-in-out;
}

.btn1-inline {
   display: inline-flex;
   align-items: center;
   justify-content: center;
   column-gap: 0.5rem;
}

.btn1-darken {
   padding: 0.75rem 2rem;
   color: var(--color-white-100);
   background-color: var(--color-black-200);
   box-shadow: var(--shadow-medium);
}

.btn1-neutral {
   padding: 0.75rem 2rem;
   color: var(--color-black-500);
   background-color: var(--color-white-100);
   box-shadow: var(--shadow-medium);
}

.header1 {
   position: fixed;
   top: 0;
   left: 0;
   z-index: 100;
   width: 100%;
   height: auto;
   margin: 0 auto;
   transition: all 0.35s ease;
}

.header1.on-scroll {
   background: var(--color-black-300);
   box-shadow: var(--shadow-medium);
}

.navbar1 {
   display: flex;
   flex-direction: row;
   align-items: center;
   justify-content: flex-start;
   column-gap: 1.25rem;
   width: 100%;
   height: 4.25rem;
   margin: 0 auto;
}

.brand1 {
   font-family: inherit;
   font-size: 1.6rem;
   font-weight: 600;
   line-height: 1.5;
   letter-spacing: -1px;
   color: var(--color-white-100);
   text-transform: uppercase;
}

.menu1 {
   position: fixed;
   top: -100%;
   left: 0;
   width: 100%;
   height: auto;
   padding: 4rem 0 3rem;
   overflow: hidden;
   background-color: var(--color-black-300);
   box-shadow: var(--shadow-medium);
   transition: all 0.4s ease-in-out;
}

.menu1.is-active {
   top: 0;
   width: 100%;
   height: auto;
}

.menu1-inner {
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;
   row-gap: 1.25rem;
}

.menu1-link {
   font-family: inherit;
   font-size: 1rem;
   font-weight: 500;
   line-height: 1.5;
   color: var(--color-white-100);
   text-transform: uppercase;
   transition: all 0.3s ease;
}

.menu1-block {
   display: inline-block;
   font-family: inherit;
   font-size: 0.875rem;
   font-weight: 500;
   line-height: 1.25;
   user-select: none;
   white-space: nowrap;
   text-align: center;
   margin-left: auto;
   padding: 0.65rem 1.5rem;
   border-radius: 3rem;
   text-transform: capitalize;
   color: var(--color-white);
   background-color: var(--color-blue-600);
   box-shadow: var(--shadow-medium);
   transition: all 0.3s ease-in-out;
}

/* Media Query Breakpoint for Menu */
@media only screen and (min-width: 48rem) {
   .menu1 {
      position: relative;
      top: 0;
      width: auto;
      height: auto;
      padding: 0rem;
      margin-left: auto;
      background: none;
      box-shadow: none;
   }

   .menu1-inner {
      display: flex;
      flex-direction: row;
      column-gap: 2rem;
      margin: 0 auto;
   }

   .menu1-link {
      text-transform: capitalize;
   }

   .menu1-block {
      margin-left: 2rem;
   }
}

.burger1 {
   position: relative;
   display: block;
   cursor: pointer;
   user-select: none;
   order: -1;
   z-index: 10;
   width: 1.6rem;
   height: 1.15rem;
   border: none;
   outline: none;
   background: none;
   visibility: visible;
   transform: rotate(0deg);
   transition: 0.35s ease;
}

/* Media Query Breakpoint for Burger */
@media only screen and (min-width: 48rem) {
   .burger1 {
      display: none;
      visibility: hidden;
   }
}

.burger1-line {
   position: absolute;
   display: block;
   left: 0;
   width: 100%;
   height: 2px;
   border: none;
   outline: none;
   opacity: 1;
   border-radius: 1rem;
   transform: rotate(0deg);
   background-color: var(--color-white-100);
   transition: 0.25s ease-in-out;
}

.burger1-line:nth-child(1) {
   top: 0px;
}

.burger1-line:nth-child(2) {
   top: 0.5rem;
   width: 70%;
}

.burger1-line:nth-child(3) {
   top: 1rem;
}

.burger1.is-active .burger1-line:nth-child(1) {
   top: 0.5rem;
   transform: rotate(135deg);
}

.burger1.is-active .burger1-line:nth-child(2) {
   opacity: 0;
   visibility: hidden;
}

.burger1.is-active .burger1-line:nth-child(3) {
   top: 0.5rem;
   transform: rotate(-135deg);
}

.banner1-column {
   position: relative;
   display: grid;
   align-items: center;
   row-gap: 3rem;
}

/* Media Query Breakpoints for Banner */
@media only screen and (min-width: 48rem) {
   .banner1-column {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      justify-content: center;
   }
}

@media only screen and (min-width: 64rem) {
   .banner1-column {
      grid-template-columns: 1fr max-content;
      column-gap: 4rem;
      margin-top: 3rem;
   }
}

.banner1-image {
   display: block;
   max-width: 18rem;
   height: auto;
   margin-top: 2rem;
   object-fit: cover;
   justify-self: center;
}

@media only screen and (min-width: 48rem) {
   .banner1-image {
      order: 1;
      max-width: 20rem;
      height: auto;
   }
}

@media only screen and (min-width: 64rem) {
   .banner1-image {
      max-width: 25rem;
      height: auto;
      margin-right: 5rem;
   }
}

.banner1-content {
   display: grid;
   align-items: start;
   row-gap: 1.25rem;
   order: -1;
}

.banner1-content-button {
   display: inline-flex;
   align-items: center;
   column-gap: 1rem;
   margin-top: 2rem;
   color: var(--color-white-100);
   font-size: 1rem;
   font-weight: 500;
}

.icon1 {
   display: inline-block;
   height: 1.25rem;
   width: 1.25rem;
}

</style>

<script>
   
   const burger1 = document.querySelector('.burger1');
const menu1 = document.querySelector('.menu1');
const header1 = document.querySelector('.header1');

burger1.addEventListener('click', () => {
   burger1.classList.toggle('is-active');
   menu1.classList.toggle('is-active');
});

window.addEventListener('scroll', () => {
   if (window.scrollY > 100) {
      header1.classList.add('on-scroll');
   } else {
      header1.classList.remove('on-scroll');
   }
});

   </script>
<<!-- Header Section -->
<header class="header1" id="header">
   <nav class="navbar1 container1">
      <a href="#" class="brand1">Brand</a>
      <div class="burger1" id="burger">
         <span class="burger1-line"></span>
         <span class="burger1-line"></span>
         <span class="burger1-line"></span>
      </div>
      <div class="menu1" id="menu">
         <ul class="menu1-inner">
            <li class="menu1-item"><a href="#" class="menu1-link">Home</a></li>
            <li class="menu1-item"><a href="#" class="menu1-link">Feature</a></li>
            <li class="menu1-item"><a href="#" class="menu1-link">Product</a></li>
            <li class="menu1-item"><a href="#" class="menu1-link">Support</a></li>
         </ul>
      </div>
      <a href="#" class="menu1-block">Discover</a>
   </nav>
</header>

<!-- Main Section -->
<main class="main">
   <section class="section1 banner1 banner1-section">
      <div class="container1 banner1-column">
         <img class="banner1-image" src="https://i.ibb.co/vB5LTFG/Headphone.png" alt="banner">
         <div class="banner1-content">
            <h1 class="heading1-xl">Experience Media Like Never Before</h1>
            <p class="paragraph1">
               Enjoy award-winning stereo beats with wireless listening freedom and sleek,
               streamlined with premium padded and delivering first-rate playback.
            </p>
            <button class="btn1 btn1-darken btn1-inline">
               Our Products<i class="bx bx-right-arrow-alt"></i>
            </button>
         </div>
         <div class="banner1-links">
            <a href="#" title=""><i class="bx bxl-facebook"></i></a>
            <a href="#" title=""><i class="bx bxl-instagram"></i></a>
            <a href="#" title=""><i class="bx bxl-twitter"></i></a>
            <a href="#" title=""><i class="bx bxl-youtube"></i></a>
         </div>
      </div>
   </section>
</main>
