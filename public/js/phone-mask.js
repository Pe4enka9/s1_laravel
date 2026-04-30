const registerPhone = document.getElementById('register_phone');
const loginPhone = document.getElementById('login_phone');
const bookingPhone = document.getElementById('booking_phone');

IMask(registerPhone, {mask: '+{7} (000) 000-00-00'});
IMask(loginPhone, {mask: '+{7} (000) 000-00-00'});
IMask(bookingPhone, {mask: '+{7} (000) 000-00-00'});
