<div class="container-fluid bg-white mt-5">
    <div class="row">
        <div class="col-lg-4 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p>
            <?php echo $settings_r['site_about'] ?>
            </p>
        </div>

        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
        </div>

        <div class="col-lg-4 p-4">
            <h5 class="mb-3">Follow Us</h5>
            <?php 
             if($contact_r['tw']!=''){
                echo<<<data
                <a href="$contact_r[tw]" class="d-inline-block text-dark text-decoration-none mb-2">
                <i class="bi bi-twitter-x me-1"></i> Twitter</a> <br>
                data;
             }
            ?>

            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark text-decoration-none mb-2">
            <i class="bi bi-facebook me-1"></i> Facebook</a> <br>

            <a href="<?php echo $contact_r['insta'] ?>" class="d-inline-block text-dark text-decoration-none">
            <i class="bi bi-instagram me-1"></i> Instagram </a> <br>
        </div>
    </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed By Binay Gupta and Binayak Rijal</h6>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Chatbot Floating Button and Popup -->
<style>
#chatbot-btn {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 9999;
  background: #343a40;
  color: #fff;
  border: none;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  font-size: 28px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  cursor: pointer;
}
#chatbot-popup {
  display: none;
  position: fixed;
  bottom: 100px;
  right: 30px;
  width: 320px;
  max-width: 90vw;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 16px rgba(0,0,0,0.3);
  z-index: 10000;
  flex-direction: column;
  overflow: hidden;
}
#chatbot-header {
  background: #343a40;
  color: #fff;
  padding: 12px;
  font-weight: bold;
  text-align: center;
}
#chatbot-messages {
  height: 260px;
  overflow-y: auto;
  padding: 10px;
  background: #f8f9fa;
  font-size: 15px;
}
#chatbot-input-area {
  display: flex;
  border-top: 1px solid #ddd;
}
#chatbot-input {
  flex: 1;
  border: none;
  padding: 10px;
  font-size: 15px;
  outline: none;
}
#chatbot-send {
  background: #343a40;
  color: #fff;
  border: none;
  padding: 0 18px;
  cursor: pointer;
  font-size: 16px;
}
</style>

<button id="chatbot-btn" title="Chat with us">
  💬
</button>
<div id="chatbot-popup">
  <div id="chatbot-header">
    Hotel Assistant
    <span style="float:right;cursor:pointer;" onclick="toggleChatbot()">&times;</span>
  </div>
  <div id="chatbot-messages"></div>
  <div id="chatbot-input-area">
    <input type="text" id="chatbot-input" placeholder="Type your message..." autocomplete="off" />
    <button id="chatbot-send">Send</button>
  </div>
</div>

<script>
function toggleChatbot() {
  var popup = document.getElementById('chatbot-popup');
  var messages = document.getElementById('chatbot-messages');
  if (popup.style.display === 'block') {
    // Closing: clear messages
    messages.innerHTML = '';
    popup.style.display = 'none';
  } else {
    // Opening: focus input
    popup.style.display = 'block';
    document.getElementById('chatbot-input').focus();
  }
}

document.getElementById('chatbot-btn').onclick = toggleChatbot;

document.getElementById('chatbot-send').onclick = sendChatbotMessage;
document.getElementById('chatbot-input').addEventListener('keypress', function(e) {
  if (e.key === 'Enter') sendChatbotMessage();
});

function appendMessage(sender, text) {
  var msgDiv = document.createElement('div');
  msgDiv.style.margin = '8px 0';
  msgDiv.innerHTML = '<b>' + sender + ':</b> ' + text;
  document.getElementById('chatbot-messages').appendChild(msgDiv);
  document.getElementById('chatbot-messages').scrollTop = document.getElementById('chatbot-messages').scrollHeight;
}

function sendChatbotMessage() {
  var input = document.getElementById('chatbot-input');
  var msg = input.value.trim();
  if (!msg) return;
  appendMessage('You', msg);
  input.value = '';
  fetch('http://127.0.0.1:5000/query', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ query: msg })
  })
  .then(response => response.json())
  .then(data => {
    appendMessage('Assistant', data.response);
  })
  .catch(() => {
    appendMessage('Assistant', "Sorry, I couldn't connect to the server.");
  });
}
</script>

<script>

    function alert(type,msg,position='body')
  {
    let bs_class = (type == 'success') ? 'alert-success': 'alert-danger';
    let element = document.createElement('div');
    element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
        <strong class="me-3">${msg}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

    if(position=='body'){
        document.body.append(element);
        element.classList.add('custom-alert');
    }
    else{
        document.getElementById(position).appendChild(element);
    }
    setTimeout(remAlert,3000);
  }

    function remAlert(){
    document.getElementsByClassName('alert')[0].remove();
     }

    function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0;i<a_tags.length;i++)
    {
     let file = a_tags[i].href.split('/').pop();
     let file_name = file.split('.')[0];

     if(document.location.href.indexOf(file_name)>=0){
        a_tags[i].classList.add('active');
     }
    }

  }
  
    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit',(e)=>{
    e.preventDefault();

      let data = new FormData(register_form);

      data.append('name',register_form.elements['name'].value);
      data.append('email',register_form.elements['email'].value);
      data.append('phonenum',register_form.elements['phonenum'].value);
      data.append('address',register_form.elements['address'].value);
      data.append('pincode',register_form.elements['pincode'].value);
      data.append('dob',register_form.elements['dob'].value);
      data.append('pass',register_form.elements['pass'].value);
      data.append('cpass',register_form.elements['cpass'].value);
      data.append('profile',register_form.elements['profile'].files[0]);
      data.append('register','');

      var myModal = document.getElementById('registerModal');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/login_register.php",true);
      
      xhr.onload = function(){
        if(this.responseText == 'pass_mismatch'){
            alert('error',"Password Mismatch!");
        }
        else if(this.responseText == 'email_already'){
            alert('error',"Email is already registered!");
        }
        else if(this.responseText == 'phone_already'){
            alert('error',"Phone is already registered!");
        }
        else if(this.responseText == 'inv_img'){
            alert('error',"Only JPG, WEBP & PNG images are allowed!");
        }
        else if(this.responseText == 'upd_failed'){
            alert('error',"Image Upload failed!");
        }
        else if(this.responseText == 'ins_failed'){
            alert('error',"Registration failed! Server down!");
        }
        else{
            alert('success',"Registration Successful")
            register_form.reset();
        }
      }

      xhr.send(data);
    });

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit',(e)=>{
    e.preventDefault();

      let data = new FormData();

      data.append('email_mob',login_form.elements['email_mob'].value);
      data.append('pass',login_form.elements['pass'].value);

      data.append('login','');

      var myModal = document.getElementById('loginModal');
      var modal = bootstrap.Modal.getInstance(myModal); 
      modal.hide();

      let xhr = new XMLHttpRequest();
      xhr.open("POST","ajax/login_register.php",true);
      
      xhr.onload = function(){
        if(this.responseText == 'inv_email_mob'){
            alert('error',"Invalid Email or Mobile Number!");
        }
        
        else if(this.responseText == 'inactive'){
            alert('error',"Account Suspended. Please Contact Admin!");
        }
        
        else if(this.responseText == 'invalid_pass'){
            alert('error',"Incorrect Password!");
        }
        else{
          let fileurl = window.location.href.split('/').pop().split('?').shift();
          if(fileurl == 'room_details.php')
          {
            window.location = window.location.href;
          } 
          else
          {
            window.location = window.location.pathname;
          }  
        }
      }

      xhr.send(data);
    });

    function checkLoginToBook(status,room_id){
        if(status){
            window.location.href='confirm_booking.php?id='+room_id;
        }
        else{
            alert('error','Please login to book room!');
        }
    }

    
   setActive();

</script>