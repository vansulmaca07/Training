<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js" integrity="sha256-lSjKY0/srUM9BE3dPm+c4fBo1dky2v27Gdjm2uoZaL0=" crossorigin="anonymous"></script>
<style>


.circle {
  position: relative;
  border: 1px solid #e5e5e5;
  border-radius: 100px;
  width: 5rem;
  height: 5rem;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.cicle-child {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

span-a {
  display: flex;
  justify-content: center;
  align-items: center;
  line-height: 1.5em;
}

.circle::before,
.circle::after {
  content: '';
  position: absolute;
  width: 100%;
  height: 1px;
  background: #e5e5e5;
}

.circle::before {
  top: 26px;
}

div::after {
  top: 52px;
}
</style>
</head>
<body>

<div class="container">
  <form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
      <input type="file" name="file[]" multiple>
      <button type="submit" name="submit">UPLOAD</button>
  </form>

</div>



<!--
<table border="1">
  <tr>
    <td>hello</td>
  </tr>
  <tr>
    <td>
<div class="circle">
  <div class="circle-child">
    <span-a>This</span-a>
    <span-a>Is</span-a>
    <span-a>Stamp</span-a>
  </div>
</div>
</table>
</td>
</tr>
    </div>

-->

    <script type="text/javascript">
        let inputStart, inputStop;

$("#scanInput")[0].onpaste = e => e.preventDefault();
// handle a key value being entered by either keyboard or scanner
var lastInput

let checkValidity = () => {
    if ($("#scanInput").val().length < 10) {
      $("#scanInput").val('')
  } else {
    $("body").append($('<div style="background:green;padding: 5px 12px;margin-bottom:10px;" id="msg">ok</div>'))
  }
  timeout = false
}

let timeout = false
$("#scanInput").keypress(function (e) {
  if (performance.now() - lastInput > 1000) {
    $("#scanInput").val('')
  }
    lastInput = performance.now();
    if (!timeout) {
    timeout = setTimeout(checkValidity, 200)
  }
});
    </script>
</body>
</html>
