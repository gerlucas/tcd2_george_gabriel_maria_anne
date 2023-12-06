const showMenu = (toggleId, navId) => {
    const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId)

    toggle.addEventListener('click', () => {
        nav.classList.toggle('show-menu')
        toggle.classList.toggle('show-icon')
    })
}

showMenu('nav-toggle', 'nav-menu')

const dropdownItems = document.querySelectorAll('.dropdown__item')

dropdownItems.forEach((item) => {
    const dropdownButton = item.querySelector('.dropdown__button')

    dropdownButton.addEventListener('click', () => {
        const showDropdown = document.querySelector('.show-dropdown')

        toggleItem(item)

        if (showDropdown && showDropdown !== item) {
            toggleItem(showDropdown)
        }
    })
})

const toggleItem = (item) => {
    const dropdownContainer = item.querySelector('.dropdown__container')

    if (item.classList.contains('show-dropdown')) {
        dropdownContainer.removeAttribute('style')
        item.classList.remove('show-dropdown')
    } else {
        dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px'
        item.classList.add('show-dropdown')
    }
}

const mediaQuery = matchMedia('(min-width: 1118px)'),
    dropdownContainer = document.querySelectorAll('.dropdown__container')

const removeStyle = () => {
    if (mediaQuery.matches) {
        dropdownContainer.forEach((e) => {
            e.removeAttribute('style')
        })

        dropdownItems.forEach((e) => {
            e.classList.remove('show-dropdown')
        })
    }
}

addEventListener('resize', removeStyle)

document.addEventListener('DOMContentLoaded', function () {
    var dropdownButton = document.querySelector('.dropdown__button');
    var dropdownContainer = document.querySelector('.dropdown__container');

    dropdownButton.addEventListener('click', function (event) {
        console.log('Clique no botão dropdown');

        console.log('Dropdown está visível:', dropdownContainer.style.display !== 'none');

        dropdownContainer.classList.add('show');

        setTimeout(function () {
            dropdownContainer.classList.remove('show');
        }, 2000);
    });

    document.querySelectorAll('.dropdown__link').forEach(function (item) {
        item.addEventListener('click', function (event) {
            console.log('Clique em um item do dropdown');
        });
    });
});

function menuToggle() {
    const toggleMenu = document.querySelector('.menu');
    toggleMenu.classList.toggle('active')
}
