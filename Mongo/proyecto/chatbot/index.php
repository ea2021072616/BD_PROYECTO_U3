<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventana Deslizante con Chatbot</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

    <div id="sliderContainer" class="slider-container">
        <!-- Botón con imagen -->
        <button id="togglePanel" class="toggle-button">
            <img id="toggleImage" src="<?=base_url?>chatbot/img-bot/bot.png" alt="Abrir Ventana" />
        </button>

        <div id="sidePanel" class="side-panel">
            <div class="panel-content">
                <span id="closePanel" class="close-btn">&times;</span>

                <!-- Chat interactivo -->
                <div class="chat-container">
                  <div class="robor-h1" >
                    <img id="toggleImage" src="<?=base_url?>chatbot/img-bot/cabeza.webp"  width="60" height="auto" />
                  </div>
                    <h2>Mijito-Bot </h2>
                    <div class="messages" id="chat-box">
                        <!-- Mensajes aparecerán aquí -->
                    </div>
                    <div class="input-area">
                        <input type="text" id="user-input" placeholder="Escribe tu mensaje..." />
                        <button class="send-button" onclick="sendMessage()">Enviar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script >
            // Seleccionar elementos
      const sliderContainer = document.getElementById('sliderContainer');
      const togglePanelButton = document.getElementById('togglePanel');
      const toggleImage = document.getElementById('toggleImage');
      const sidePanel = document.getElementById('sidePanel');
      const closePanelButton = document.getElementById('closePanel'); // Botón de cerrar (X)

      // Función para alternar la visibilidad del panel
      togglePanelButton.addEventListener('click', () => {
          const isVisible = sliderContainer.style.right === '0px';

          if (isVisible) {
              sliderContainer.style.right = '-420px';  // Ocultar la ventana y el botón
              toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
          } else {
              sliderContainer.style.right = '0';  // Mostrar la ventana y el botón
              toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Cerrar Ventana"
          }
      });

      // Función para cerrar el panel al hacer clic en la "X"
      closePanelButton.addEventListener('click', () => {
          sliderContainer.style.right = '-420px';  // Ocultar el panel
          toggleImage.src = '<?=base_url?>chatbot/img-bot/bot.png';  // Cambiar la imagen a la de "Abrir Ventana"
      });


    </script>

    <script>
      let conversationId = null; // Guardará el ID de la conversación actual

      // Función para mostrar los mensajes en el chat
      function appendMessage(message, type) {
        const chatBox = document.getElementById('chat-box');
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', type);
        messageDiv.innerHTML = formatBoldText(message);  // Procesar el texto antes de insertarlo
        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll al último mensaje
      }

      // Función para enviar el mensaje
      async function sendMessage() {
        const userInput = document.getElementById('user-input').value;
        if (!userInput.trim()) return;

        // Mostrar mensaje del usuario
        appendMessage(userInput, 'user-message');

        // Limpiar campo de entrada
        document.getElementById('user-input').value = '';

        // Mostrar los puntos de "escribiendo..."
        const typingIndicator = document.createElement('div');
        typingIndicator.classList.add('message', 'bot-message', 'typing-indicator');
        typingIndicator.innerHTML = "<span>  . </span><span> . </span><span> . </span>";
        document.getElementById('chat-box').appendChild(typingIndicator);
        document.getElementById('chat-box').scrollTop = document.getElementById('chat-box').scrollHeight;

        // Llamada a la API
        const response = await fetch('https://api.vectorshift.ai/api/chatbots/run', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Api-Key': '', // Reemplazar con tu API Key sk_YKChRAtFYuDRPX3JtdvwKf48FMAG6ZfbuYXmme38xT8SuK0W
          },
          body: JSON.stringify({
            input: userInput,
            chatbot_name: 'bot-db',
            username: 'tapiad',
            conversation_id: conversationId,
          }),
        });

        const data = await response.json();

        // Eliminar los puntos de "escribiendo..."
        typingIndicator.remove();

        if (data && data.output) {
          // Mostrar respuesta del bot con el formato de negrita aplicado
          appendMessage(data.output, 'bot-message');

          // Actualizar conversationId si es necesario
          if (data.conversation_id) {
            conversationId = data.conversation_id;
          }
        } else {
          appendMessage('Error al obtener respuesta del chatbot.', 'bot-message');
        }
      }

      // Función para convertir **texto** en negrita
      function formatBoldText(text) {
        // Usar una expresión regular para encontrar texto entre ** y convertirlo a <strong>
        return text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
      }
    </script>

</body>
</html>
