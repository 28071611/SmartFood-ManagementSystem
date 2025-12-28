<div id="chatbox" style="width:300px;border:1px solid #ccc;padding:10px;">
  <div id="messages" style="height:150px;overflow-y:auto;margin-bottom:10px;"></div>
  <input type="text" id="userInput" placeholder="Type your message..." style="width:70%;">
  <button onclick="sendMessage()">Send</button>
</div>
<script>
function sendMessage() {
  var input = document.getElementById('userInput').value;
  if (!input.trim()) return;
  var messages = document.getElementById('messages');
  messages.innerHTML += '<div><b>You:</b> ' + input + '</div>';
  document.getElementById('userInput').value = '';
  fetch('chatbot_backend.php', {
    method: 'POST',
    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
    body: 'message=' + encodeURIComponent(input)
  })
  .then(response => response.text())
  .then(reply => {
    messages.innerHTML += '<div><b>Bot:</b> ' + reply + '</div>';
    messages.scrollTop = messages.scrollHeight;
  });
}
</script>
