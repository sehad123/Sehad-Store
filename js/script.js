// membuat waktu mundur untuk flashsale
var deadline = new Date('Apr 30, 2023 23:59:00').getTime();
var countTime = setInterval(function () {
var container = document.getElementById('flashsale');
    var now = new Date().getTime();
    var different = deadline - now;

    var day = Math.floor(different / (1000 * 60 * 60 * 24));
    var hour = Math.floor(different % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    var minute = Math.floor(different % (1000 * 60 * 60) / (1000 * 60));
    var second = Math.floor(different % (1000 * 60) / (1000));

    var teks = document.getElementById('time');
    teks.innerHTML = 'Flash sale berakhir pada : ' + day + ' day ' + hour + ':' + minute + ':' + second;

    if (different <= 0) {
        clearInterval(countTime);
        time.innerHTML = 'Maaf Flash sale telah Berakhir';
        container.style.display = 'none';
    }

}, 1000);

// membuat slide otomatis
var counter = 1;
setInterval(function () {
    document.getElementById('radio' + counter).checked = true;
    counter++;
    if (counter > 4) {
        counter = 1;
    }
}, 5000);

// membuat menu hamburger
var nav = document.querySelector('.nav');
document.querySelector('.menu-toggle').onclick = function () {
    nav.classList.toggle('active');
};
