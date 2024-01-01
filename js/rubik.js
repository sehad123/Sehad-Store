// fitur search produk
var list = document.querySelector('.container ul');
var b = document.querySelector('form#forms img');
var search = document.forms['forms'].querySelector('input');
search.addEventListener('keyup', function (e) {
    var term = e.target.value.toLowerCase();
    var rubik = list.getElementsByTagName('li');
    Array.from(rubik).forEach(function (r) {
        var title = r.firstElementChild.textContent;
        if (title.toLowerCase().indexOf(term) != -1) {
            r.style.display = 'inline-block';
            b.style.display = 'none';
        }
        else {
            r.style.display = 'none';
            b.style.display = 'inline';
        }
    });
});


