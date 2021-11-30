const mySlider = new Slider({
    alias: '#my-slider',
	orientation: 'horizontal',
    autoChange: true,
	timer: 2000,
	draggable: true
});

// slider pagination
const dots = document.querySelectorAll('.pag');
dots.forEach((el, index) => {
	el.addEventListener('click', () => {
		mySlider.changeSlide(index);
		mySlider.autoChange = false;
	});
});

/* ==================== UI functions ==================== */

// theme switch
document.getElementById('theme-switch').addEventListener('change', e => {
	if(e.target.checked){
		document.body.classList = "theme-light";
	} else {
		document.body.classList = "theme-dark";
	}
});

// menu toggle
let menuOpen = false;
const menuToggleBtn = document.getElementById('menu-toggle');
const websiteMenu = document.getElementById('website-menu');

function toggle() {
	menuOpen = !menuOpen;
	if (menuOpen) {
		menuToggleBtn.classList.add('open');
		websiteMenu.classList.add('open');
	} else {
		menuToggleBtn.classList.remove('open');
		websiteMenu.classList.remove('open');
	}
}
menuToggleBtn.addEventListener('click', toggle);

document.querySelectorAll('li.sub-menu-link').forEach(el => {
	const submenu = el.querySelector('ul.sub-menu');
	el.addEventListener('click', () => {
		submenu.classList.toggle('open');
	});
});


// login form popup
let formOpen = false;
const openFormBtn = document.getElementById('open-form');
const closeFormBtn = document.getElementById('close-form');
const popup = document.querySelector('.login-popup');

openFormBtn.addEventListener('click', () => {
	popup.classList.add('open');
});
closeFormBtn.addEventListener('click', () => {
	popup.classList.remove('open');
});


// window.addEventListener('load', toggle);