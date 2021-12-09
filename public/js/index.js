/* ==================== Recommended Slider =============== */
const sliderContainer = document.getElementById('my-slider');
if(sliderContainer){
	const mySlider = new Slider({
		alias: '#my-slider',
		orientation: 'horizontal',
		autoChange: true,
		timer: 5000,
		draggable: true
	});
	sliderContainer.addEventListener('click', () => {mySlider.autoChange=false;});
	
	// slider pagination
	const dots = document.querySelectorAll('.slider-pag');
	dots.forEach((el, index) => {
		el.addEventListener('click', () => {
			mySlider.changeSlide(index);
			mySlider.autoChange = false;
		});
	});
}
/* ====================================================== */

/* ====================== Markdown ====================== */
const articleContent = document.getElementById('article-content');
if(articleContent){
	const md = window.markdownit();
	articleContent.innerHTML = md.render(articleContent.innerHTML); 
}

const newArticleContent = document.getElementById('new-article-content');
if(newArticleContent){
	const mde = new EasyMDE({element: newArticleContent});
}
/* ====================================================== */

/* ==================== UI functions ==================== */

// theme switch
let themeSwitch = document.getElementById('theme-switch');
function switchTheme() {
	if(themeSwitch.checked){
		localStorage.setItem('theme', 'light');
		document.body.classList = "theme-light";
	} else {
		localStorage.setItem('theme', 'dark');
		document.body.classList = "theme-dark";
	}
}
document.getElementById('theme-switch').addEventListener('change', switchTheme);

// menu toggle (for mobile menu)
let menuOpen = false;
const menuToggleBtn = document.getElementById('menu-toggle');
const websiteMenu = document.getElementById('website-menu');

function toggleMenu() {
	menuOpen = !menuOpen;
	if (menuOpen) {
		menuToggleBtn.classList.add('open');
		websiteMenu.classList.add('open');
	} else {
		menuToggleBtn.classList.remove('open');
		websiteMenu.classList.remove('open');
	}
}
menuToggleBtn.addEventListener('click', toggleMenu);

// login form popup
let formOpen = false;
const openFormBtn = document.getElementById('open-form');
const closeFormBtn = document.getElementById('close-form');
const popup = document.querySelector('.login-popup');

if(openFormBtn){
	openFormBtn.addEventListener('click', () => {
		popup.classList.add('open');
	});
	closeFormBtn.addEventListener('click', () => {
		popup.classList.remove('open');
	});
}


// messages
const messages = document.querySelectorAll('.message');
messages.forEach(msg => {
	msg.addEventListener('click', e => {
		msg.remove();
	});
});

window.addEventListener('load', () => {
	if(!localStorage.getItem('theme')){
		localStorage.setItem('theme', 'dark');
	}
	let theme = localStorage.getItem('theme');
	if(theme === 'light'){
		themeSwitch.checked = true;
		switchTheme();
	}
});