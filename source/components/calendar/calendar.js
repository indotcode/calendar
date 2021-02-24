import axios from 'axios';

export function ajaxMonthsYear(elm, type) {
    let data = new FormData();
    data.append('months', elm.getAttribute('data-months'));
    data.append('year', elm.getAttribute('data-year'));
    data.append('id', elm.getAttribute('data-id'));
    data.append('option', optionCalendar);
    axios.post('/calendar/ajax/'+type, data).then(function (response) {
        switch (type){
            case 'params':
                document.querySelector('.calendar__navigation-date-year').innerHTML = response.data.current_months;
                document.querySelector('.calendar__navigation-date-months').innerHTML = response.data.current_year;
                document.querySelector('.calendar__navigation-prev').setAttribute('data-year', response.data.navigation.prev.year);
                document.querySelector('.calendar__navigation-prev').setAttribute('data-months', response.data.navigation.prev.months);
                document.querySelector('.calendar__navigation-next').setAttribute('data-year', response.data.navigation.next.year);
                document.querySelector('.calendar__navigation-next').setAttribute('data-months', response.data.navigation.next.months);
                break;
            case 'view':
                let calendar__mounts = document.querySelector('.calendar__mounts');
                calendar__mounts.style.opacity = 0;
                calendar__mounts.innerHTML = response.data;
                setTimeout(() => {
                    calendar__mounts.style.opacity = 1;
                }, 500);
                break;
        }
    });
}
(() => {
    // console.log(option_calendar);
    let prev = document.querySelector('.calendar__navigation-prev');
    if(prev){
        prev.addEventListener('click', (e) => {
            let elm = e.currentTarget;
            ajaxMonthsYear(elm, 'view');
            ajaxMonthsYear(elm, 'params');
        })
    }

    let next = document.querySelector('.calendar__navigation-next');
    if(next){
        next.addEventListener('click', (e) => {
            let elm = e.currentTarget;
            ajaxMonthsYear(elm, 'view');
            ajaxMonthsYear(elm, 'params');
        })
    }
})();
