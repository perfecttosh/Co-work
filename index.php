<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Сохранение текста</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<style>
#saveContainer {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 40px;
}

button {
  outline: none;
  border: none;
  border-radius: 10px;
  background: green;
  color: #fff;
  border: 1px solid green;
  cursor: pointer;
  padding: 12px 24px;
  font-size: 20px;
  text-transform: uppercase;
  transition: 0.4s ease;
}

button:hover {
  transform: scale(0.95);
}

input {
  padding: 12px 24px;
}

.quiz_line {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

input[type='radio'] {
  display: none;
}

label {
  padding: 20px;
  display: grid;
  place-items: center;
  background: green;
  color: #fff;
  cursor: pointer;
}

input[type='radio']:checked+label {
  background: #f00;
}

h2 {
  text-align: center;
}

.quiz_row {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  margin-bottom: 30px;
}

button {
  display: block;
  width: fit-content;
  margin-inline: auto;
}
</style>

<body>

  <div id="saveContainer">
    <form action="send.php" method="post">
      <h2>Первый вопрос</h2>
      <input type='hidden' name='id' value='0'>
      <div class="quiz_row">
        <div class="quiz_answer">
          <input type="radio" name="quiz1" id="quiz1-1" value="Называет время" />
          <label for="quiz1-1">Называет время</label>
        </div>

        <div class="quiz_answer">
          <input type="radio" name="quiz1" id="quiz1-2" value="Сегодня не удобно" />
          <label for="quiz1-2">Сегодня не удобно</label>
        </div>

        <div class="quiz_answer">
          <input type="radio" name="quiz1" id="quiz1-3" value="Сбрасывает трубку" />
          <label for="quiz1-3">Сбрасывает трубку</label>
        </div>
      </div>
      <button type="submit">Отправить</button>
    </form>
  </div>

  <script>
  async function send(e) {
    const form = e.target
    e.preventDefault()
    const formData = new FormData(form)

    $.ajax({
      url: 'send.php',
      type: 'POST',
      cache: false,
      contentType: false,
      processData: false,
      data: formData,

      success: (response) => {
        console.log(response);
        // alert(`Ответ от сервера: ${response}`);
        createLine(response);
      },
    })
  }

  const saveContainer = document.querySelector('#saveContainer')
  const form = document.querySelector('form')
  form.addEventListener('submit', (e) => send(e))

  function createLine(answer) {
    const quizLine = `
  <form action="send.php" method="post" >
    <h2>${answer.title}</h2>
        <input type='hidden' name='id' value='${answer.id}'>
        <div class="quiz_row">
        <div class="quiz_answer">
          <input type="radio" name="quiz${id}" id="quiz1-1" value="Называет время" />
          <label for="quiz1-1">Называет время</label>
        </div>

        <div class="quiz_answer">
          <input type="radio" name="quiz${id}" id="quiz1-2" value="Сегодня не удобно" />
          <label for="quiz1-2">Сегодня не удобно</label>
        </div>

        <div class="quiz_answer">
          <input type="radio" name="quiz${id}" id="quiz1-3" value="Сбрасывает трубку" />
          <label for="quiz1-3">Сбрасывает трубку</label>
        </div>
      </div>
      <button type="submit">Отправить</button>
      </form>
        `;
    saveContainer.insertAdjacentHTML("beforeend", quizLine);
  }
  </script>
</body>

</html>