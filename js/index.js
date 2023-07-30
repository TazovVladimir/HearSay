let counter = 0;
let sl_pos_new = 0;

let sliderMain = document.getElementById('slider-main');
let slides = document.querySelectorAll('.slider-item');
let leftBtn = document.getElementById('arr-left');
let rightBtn = document.getElementById('arr-right');

rightBtn.addEventListener('click', () => {
    if (slides.length > counter + 1) {
        counter = counter + 1;
        sl_pos_new = 1200 * counter;
        sliderMain.style.transform = "translateX(-" + sl_pos_new + "px)";
    } else {
        sliderMain.style.transform = "translateX(0px)";
        counter = 0;
        sl_pos_new = 0;
    }
});

leftBtn.addEventListener('click', () => {
    if(counter == 0){
        counter = slides.length -1;
        sl_pos_new = 1200 * counter;
        sliderMain.style.transform = "translateX(-" + sl_pos_new + "px)";
    }else{
        counter = counter - 1;
        sl_pos_new = 1200 * counter;
        sliderMain.style.transform = "translateX(-" + sl_pos_new + "px)";
    }
});

function right(){
    if (slides.length > counter + 1) {
        counter = counter + 1;
        sl_pos_new = 1200 * counter;
        sliderMain.style.transform = "translateX(-" + sl_pos_new + "px)";
    } else {
        sliderMain.style.transform = "translateX(0px)";
        counter = 0;
        sl_pos_new = 0;
    }
}

setInterval(right, 5000);




const smoothLinks = document.querySelectorAll('a[href^="#"]');
for (let smoothLink of smoothLinks) {
    smoothLink.addEventListener('click', function (e) {
        e.preventDefault();
        const id = smoothLink.getAttribute('href');

        document.querySelector(id).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });
};