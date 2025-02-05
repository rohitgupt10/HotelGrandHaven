
function get_bookings(search='')
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/booking_records.php",true);
  xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');

  xhr.onload = function(){
   document.getElementById('table-data').innerHTML = this.responseText;
  }

  xhr.send('get_bookings&search='+search);
}


window.onload = function(){
  get_bookings();
}
